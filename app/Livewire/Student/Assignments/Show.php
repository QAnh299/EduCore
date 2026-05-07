<?php

namespace App\Livewire\Student\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Assignment $assignment;

    public $assignmentId;

    public $grade ;

    public function mount($assignmentId)
    {
        $this->assignment = Assignment::findOrFail($assignmentId);

        $this->grade = Grade::where('student_id', Auth::id())
            ->where('assignment_id', $assignmentId)
            ->first();
    }

    public function loadAssignment()
    {
        $student = Auth::user()->student;

        if (!$student) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        // Load assignment
        $this->assignment = Assignment::with([
            'classroom',
            'classroom.teachers',
        ])
        ->whereHas('classroom.students', function ($q) use ($student) {
            $q->where('users.id', $student->user_id);
        })
        ->findOrFail($this->assignmentId);

        // Load điểm của học viên
        $this->grade = Grade::where('assignment_id', $this->assignment->id)
            ->where('student_id', $student->user_id)
            ->first();
    }

    // Đã nộp = đã có điểm
    public function isSubmitted()
    {
        return $this->grade !== null;
    }

    // Chưa nộp
    public function isUnsubmitted()
    {
        return $this->grade === null;
    }

    // Trạng thái badge
    public function getStatusBadge()
    {
        if ($this->isSubmitted()) {
            return [
                'text' => 'Đã nộp',
                'class' => 'badge-success',
            ];
        }

        return [
            'text' => 'Chưa nộp',
            'class' => 'badge-warning',
        ];
    }

    // Điểm
    public function getScore()
    {
        return $this->grade?->score;
    }

    // Nhận xét
    public function getFeedback()
    {
        return $this->grade?->feedback;
    }

    public function render()
    {
        return view('student.assignments.show');
    }
}