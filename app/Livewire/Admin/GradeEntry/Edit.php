<?php

namespace App\Livewire\Admin\GradeEntry;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;
use App\Models\Assignment;

class Edit extends Component
{
    public $grade;
    public $grade_type;
    public $assignment_id;

    public $score;
    public $feedback;
    public $graded_at;
    public $assignments;

    public function mount(Grade $grade)
    {
        $this->grade = $grade;
        $this->grade_type = $grade->grade_type;
        $this->assignment_id = $grade->assignment_id;

        $this->score = $grade->score;
        $this->feedback = $grade->feedback;
        $this->graded_at = $grade->graded_at;
        $this->loadAssignments();
    }
    public function updatedGradeType()
    {
        if ($this->grade_type === 'homework') {
            $this->loadAssignments();
        } else {
            $this->assignment_id = null;
        }
    }
    public function loadAssignments()
    {
        $this->assignments = Assignment::orderByDesc('deadline')->get();
    }
    public function update()
    {
        $this->validate([
            'grade_type' => 'required',
            'assignment_id' => 'required_if:grade_type,homework|nullable|exists:assignments,id',
            'score' => 'required|numeric|min:0|max:10',
            'graded_at' => 'required|date'
        ]);

        $this->grade->update([
            'grade_type' => $this->grade_type,
            'assignment_id' => $this->assignment_id,
            'score' => $this->score,
            'feedback' => $this->feedback,
            'graded_at' => $this->graded_at
            //thêm
            
        ]);

        session()->flash('success', 'Cập nhật điểm thành công');

        return redirect()->route('grade-entry.show', $this->grade->student_id);
    }
    public function render()
    {
        return view('admin.grade-entry.edit');
    }
}
