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
     * Tính xếp hạng toàn hệ thống
     */
    private function calculateRank()
    {
        $students = User::where('role', 'student')->get();

        $scores = [];

        foreach ($students as $student) {

            $homework = Grade::where('student_id', $student->id)
                ->where('grade_type', 'Bài về nhà')
                ->avg('score');

            $minitest = Grade::where('student_id', $student->id)
                ->where('grade_type', 'minitest')
                ->avg('score');

            $exam = Grade::where('student_id', $student->id)
                ->where('grade_type', 'Kiểm tra cuối tháng')
                ->avg('score');

            $homework = $homework ?? 0;
            $minitest = $minitest ?? 0;
            $exam = $exam ?? 0;

            $average =
                ($homework * 0.1) +
                ($minitest * 0.3) +
                ($exam * 0.6);

            if ($average > 0) {
                $scores[$student->id] = round($average, 1);
            }
        }

        arsort($scores);

        $this->totalStudents = count($scores);

        $rank = array_search(
            Auth::id(),
            array_keys($scores)
        );

        $this->rank = $rank !== false
            ? $rank + 1
            : null;
    }

    public function render()
    {
        return view('student.grade.index', [
            'grades' => $this->grades
        ]);
    }
}