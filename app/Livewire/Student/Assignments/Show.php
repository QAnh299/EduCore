<?php

namespace App\Livewire\Student\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Assignment $assignment;

    public $grade;

    public function mount($assignmentId)
    {
        $student = Auth::user();

        // Load assignment
        $this->assignment = Assignment::with([
            'classroom',
            'classroom.teachers',
        ])->findOrFail($assignmentId);

        // Load điểm của học viên
        $this->grade = Grade::where('assignment_id', $assignmentId)
            ->where('student_id', $student->id)
            ->first();
    }

    // Đã có điểm
    public function isSubmitted()
    {
        return $this->grade !== null;
    }

    // Badge trạng thái
    public function getStatusBadge()
    {
        if ($this->isSubmitted()) {
            return [
                'text' => 'Đã nộp',
                'class' => 'bg-success',
            ];
        }

        return [
            'text' => 'Chưa nộp',
            'class' => 'bg-warning text-dark',
        ];
    }

    public function render()
    {
        return view('student.assignments.show');
    }
}