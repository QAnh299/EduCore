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
     * Tính điểm trung bình theo công thức:
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
     * Lấy xếp hạng toàn bộ học viên
     */
    public function getStudentRank($studentId, $students = null)
    {
        $allStudents = User::where('role', 'student')->get();

        $scores = [];

        foreach ($allStudents as $student) {

            $average = $this->calculateAverage($student->id);

            if ($average > 0) {

                $scores[] = [
                    'id' => $student->id,
                    'average_score' => $average,
                    'name' => $student->name,
                ];
            }
        }

        usort($scores, function ($a, $b) {

            if ($a['average_score'] == $b['average_score']) {
                return strcmp($a['name'], $b['name']);
            }

            return $b['average_score'] <=> $a['average_score'];
        });

        foreach ($scores as $index => $student) {

            if ($student['id'] == $studentId) {
                return $index + 1;
            }
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
     * Gắn average_score cho từng học viên
     */
    $students->transform(function ($student) {

        $student->average_score = $this->calculateAverage(
            $student->id
        );

        return $student;
    });

    /**
     * Có điểm -> lên đầu
     */
    $rankedStudents = $students

        ->filter(function ($student) {

            return $student->average_score > 0;
        })

        ->sort(function ($a, $b) {

            if ($a->average_score == $b->average_score) {
                return strcmp($a->name, $b->name);
            }

            return $b->average_score <=> $a->average_score;
        });

    /**
     * Chưa có điểm -> xuống cuối
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