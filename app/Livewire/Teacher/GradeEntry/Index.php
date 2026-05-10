<?php

namespace App\Livewire\Teacher\GradeEntry;

use App\Models\Classroom;
use App\Models\User;
use App\Models\Grade;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $classroomFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'classroomFilter' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedClassroomFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'classroomFilter',
        ]);

        $this->resetPage();
    }

    /**
     * Tính điểm trung bình:
     * homework 10%
     * minitest 30%
     * monthly_exam 60%
     */
    private function calculateAverage($studentId)
    {
        $homework = Grade::where('student_id', $studentId)
            ->where('grade_type', 'homework')
            ->avg('score');

        $minitest = Grade::where('student_id', $studentId)
            ->where('grade_type', 'minitest')
            ->avg('score');

        $exam = Grade::where('student_id', $studentId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score');

        $homework = $homework ?? 0;
        $minitest = $minitest ?? 0;
        $exam = $exam ?? 0;

        $average =
            ($homework * 0.1) +
            ($minitest * 0.3) +
            ($exam * 0.6);

        return round($average, 1);
    }

    /**
     * Lấy rank theo khối
     * Đồng điểm => cùng rank
     */
    public function getStudentRank($studentId)
{
    $currentStudent = User::with('classrooms')
        ->find($studentId);

    if (
        !$currentStudent ||
        $currentStudent->classrooms->isEmpty()
    ) {
        return null;
    }

    /**
     * Lấy khối hiện tại từ tên lớp
     * Ví dụ:
     * Lớp 6A -> 6
     * Lớp 7B -> 7
     */
    $currentClassroom = $currentStudent
        ->classrooms
        ->first();

    preg_match('/\d+/', $currentClassroom->name, $matches);

    $currentGrade = $matches[0] ?? null;

    if (!$currentGrade) {
        return null;
    }

    /**
     * Lấy học viên cùng khối
     */
    $students = User::where('role', 'student')
        ->with('classrooms')
        ->get()
        ->filter(function ($student) use ($currentGrade) {

            if ($student->classrooms->isEmpty()) {
                return false;
            }

            $classroomName = $student
                ->classrooms
                ->first()
                ->name;

            preg_match('/\d+/', $classroomName, $matches);

            $studentGrade = $matches[0] ?? null;

            return $studentGrade == $currentGrade;
        });

    $scores = [];

    foreach ($students as $student) {

        $average = $this->calculateAverage(
            $student->id
        );

        if ($average > 0) {

            $scores[] = [
                'id' => $student->id,
                'name' => $student->name,
                'average_score' => $average,
            ];
        }
    }

    /**
     * Sort:
     * Điểm giảm dần
     * Nếu bằng điểm -> sort tên
     */
    usort($scores, function ($a, $b) {

        if (
            $a['average_score']
            ==
            $b['average_score']
        ) {
            return strcmp(
                $a['name'],
                $b['name']
            );
        }

        return $b['average_score']
            <=>
            $a['average_score'];
    });

    /**
     * Đồng điểm => cùng rank
     * Ví dụ:
     * 1,1,3,4
     */
    $rank = 1;

    $previousScore = null;

    foreach ($scores as $index => $student) {

        if (
            $previousScore !== null &&
            $student['average_score'] < $previousScore
        ) {
            $rank = $index + 1;
        }

        if ($student['id'] == $studentId) {

            return $rank;
        }

        $previousScore = $student['average_score'];
    }

    return null;
}

    public function render()
{
    $classrooms = Classroom::orderBy('name')->get();

    $students = User::query()

        ->where('role', 'student')

        ->with('classrooms')

        ->when($this->search, function ($query) {

            $query->where(
                'users.name',
                'like',
                '%' . $this->search . '%'
            );
        })

        ->when($this->classroomFilter, function ($query) {

            $query->whereHas('classrooms', function ($q) {

                $q->where(
                    'classrooms.id',
                    $this->classroomFilter
                );
            });
        })

        ->get();

    /**
     * Gắn average_score + grade_level
     */
    $students->transform(function ($student) {

        $student->average_score =
            $this->calculateAverage(
                $student->id
            );

        /**
         * Lấy khối từ tên lớp
         * Ví dụ:
         * Lớp 6A -> 6
         */
        if ($student->classrooms->isNotEmpty()) {

            $classroomName = $student
                ->classrooms
                ->first()
                ->name;

            preg_match('/\d+/', $classroomName, $matches);

            $student->grade_level =
                $matches[0] ?? 0;

        } else {

            $student->grade_level = 0;
        }

        return $student;
    });

    /**
     * Chỉ lấy học viên có điểm
     */
    $rankedStudents = $students

        ->filter(function ($student) {

            return $student->average_score > 0;
        })

        /**
         * Sort theo:
         * 1. Khối tăng dần
         * 2. Điểm giảm dần
         * 3. Tên tăng dần
         */
        ->sort(function ($a, $b) {

            /**
             * Sort theo khối
             */
            if (
                $a->grade_level
                !=
                $b->grade_level
            ) {

                return $a->grade_level
                    <=>
                    $b->grade_level;
            }

            /**
             * Sort theo điểm
             */
            if (
                $a->average_score
                !=
                $b->average_score
            ) {

                return $b->average_score
                    <=>
                    $a->average_score;
            }

            /**
             * Sort theo tên
             */
            return strcmp(
                $a->name,
                $b->name
            );
        });

    /**
     * Học viên chưa có điểm
     */
    $unrankedStudents = $students

        ->filter(function ($student) {

            return $student->average_score <= 0;
        });

    /**
     * Gộp lại
     */
    $students = $rankedStudents
        ->concat($unrankedStudents)
        ->values();

    return view('teacher.grade-entry.index', [
        'students' => $students,
        'classrooms' => $classrooms,
    ]);
}
}