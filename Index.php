<?php

namespace App\Livewire\Student\Grade;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;

class Index extends Component
{
    public $grades;
    public $average = 0;
    public $rank = 0;
    public $totalStudents = 0;

    public function mount()
    {
        $this->grades = Grade::where('student_id', auth()->id())
            ->with(['teacher', 'assignment'])
            ->orderByDesc('graded_at')
            ->get();

        $this->calculateAverage();
        $this->calculateRank();
    }

    /**
     * Tính điểm tổng kết (không tính Quiz).
     * Công thức: TB(BTVN) * 10% + TB(Minitest) * 30% + TB(Cuối tháng) * 60%
     */
    private function calculateAverage()
    {
        $studentId = auth()->id();

        $hasGrades = Grade::where('student_id', $studentId)
            ->whereIn('grade_type', ['homework', 'minitest', 'monthly_exam'])
            ->exists();

        if (!$hasGrades) {
            $this->average = 0;
            return;
        }

        $homework = Grade::where('student_id', $studentId)
            ->where('grade_type', 'homework')
            ->avg('score') ?? 0;

        $minitest = Grade::where('student_id', $studentId)
            ->where('grade_type', 'minitest')
            ->avg('score') ?? 0;

        $exam = Grade::where('student_id', $studentId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score') ?? 0;

        $this->average = round($homework * 0.1 + $minitest * 0.3 + $exam * 0.6, 2);
    }

    private function calculateRank()
    {
        $students = User::where('role', 'student')->get();

        $scores = [];

        foreach ($students as $student) {
            $hasGrades = Grade::where('student_id', $student->id)
                ->whereIn('grade_type', ['homework', 'minitest', 'monthly_exam'])
                ->exists();

            if (!$hasGrades) {
                $scores[$student->id] = 0;
                continue;
            }

            $homework = Grade::where('student_id', $student->id)
                ->where('grade_type', 'homework')
                ->avg('score') ?? 0;

            $minitest = Grade::where('student_id', $student->id)
                ->where('grade_type', 'minitest')
                ->avg('score') ?? 0;

            $exam = Grade::where('student_id', $student->id)
                ->where('grade_type', 'monthly_exam')
                ->avg('score') ?? 0;

            $scores[$student->id] = round($homework * 0.1 + $minitest * 0.3 + $exam * 0.6, 2);
        }

        arsort($scores);

        $rank = array_search(auth()->id(), array_keys($scores));
        $this->rank = ($rank !== false) ? $rank + 1 : '-';
        $this->totalStudents = count($scores);
    }

    public function render()
    {
        return view('student.grade.index', [
            'grades' => $this->grades,
        ]);
    }
}
