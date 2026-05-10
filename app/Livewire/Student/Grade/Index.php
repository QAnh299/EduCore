<?php

namespace App\Livewire\Student\Grade;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $grades;

    public $average = 0;

    public $rank = null;

    public $totalStudents = 0;

    public function mount()
    {
        $this->grades = Grade::where('student_id', Auth::id())

            ->with([
                'teacher',
                'assignment'
            ])

            ->orderByDesc('graded_at')

            ->get();

        $this->calculateAverage();

        $this->calculateRank();
    }

    /**
     * Tính điểm trung bình:
     * homework 10%
     * minitest 30%
     * monthly_exam 60%
     */
    private function calculateAverage()
    {
        $homework = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'homework')
            ->avg('score');

        $minitest = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'minitest')
            ->avg('score');

        $exam = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'monthly_exam')
            ->avg('score');

        $homework = $homework ?? 0;
        $minitest = $minitest ?? 0;
        $exam = $exam ?? 0;

        $this->average = round(
            ($homework * 0.1) +
            ($minitest * 0.3) +
            ($exam * 0.6),
            1
        );
    }

    /**
     * Tính rank theo khối
     * Đồng điểm => cùng rank
     */
    private function calculateRank()
    {
        /**
         * Lấy học viên hiện tại
         */
        $currentStudent = User::with('classrooms')
            ->find(Auth::id());

        if (
            !$currentStudent ||
            $currentStudent->classrooms->isEmpty()
        ) {
            return;
        }

        /**
         * Lấy khối hiện tại
         * Ví dụ:
         * Toán lớp 6A -> 6
         */
        $classroomName = $currentStudent
            ->classrooms
            ->first()
            ->name;

        preg_match('/\d+/', $classroomName, $matches);

        $currentGrade = $matches[0] ?? null;

        if (!$currentGrade) {
            return;
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

        /**
         * Tính điểm TB cho từng học viên
         */
        foreach ($students as $student) {

            $homework = Grade::where('student_id', $student->id)
                ->where('grade_type', 'homework')
                ->avg('score');

            $minitest = Grade::where('student_id', $student->id)
                ->where('grade_type', 'minitest')
                ->avg('score');

            $exam = Grade::where('student_id', $student->id)
                ->where('grade_type', 'monthly_exam')
                ->avg('score');

            $homework = $homework ?? 0;
            $minitest = $minitest ?? 0;
            $exam = $exam ?? 0;

            $average =
                ($homework * 0.1) +
                ($minitest * 0.3) +
                ($exam * 0.6);

            $average = round($average, 1);

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

        $this->totalStudents = count($scores);

        /**
         * Rank kiểu:
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

            if ($student['id'] == Auth::id()) {

                $this->rank = $rank;

                return;
            }

            $previousScore = $student['average_score'];
        }
    }

    public function render()
    {
        return view('student.grade.index', [
            'grades' => $this->grades
        ]);
    }
}