<?php

namespace App\Livewire\Assistant\GradeEntry;

use Livewire\Component;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Grade;

class Create extends Component
{
    public $student;
    public $classroom;

    public $grade_type = 'homework';
    public $assignment_id = null;
    public $assistant_id = null;
    public $score;
    public $feedback;
    public $graded_at;

    public $assignments;
    public $assistants;

    public function mount(User $student)
    {
        $this->student = $student->load('classrooms');

        $this->classroom = $this->student->classrooms->first();

        if (!$this->classroom) {
            abort(404, 'Học viên chưa được gán lớp');
        }

        $this->graded_at = now()->format('Y-m-d');

        $this->assignments = collect();
        $this->assistants = collect();

        $this->loadassistants();
        $this->loadAssignments();
    }

    public function updatedType()
    {
        if ($this->grade_type === 'homework') {
            $this->loadAssignments();
        } else {
            $this->assignment_id = null;
        }
    }

    public function loadAssignments()
    {
        $this->assignments = Assignment::where('class_id', $this->classroom->id)
            ->orderByDesc('deadline')
            ->get();
    }

    public function loadassistants()
    {
        $this->assistants = $this->classroom
            ->users()
            ->wherePivot('role', 'assistant')
            ->get();
    }

    protected function rules()
    {
        return [
            'grade_type' => 'required',
            'assignment_id' => 'required_if:type,homework|nullable|exists:assignments,id',
            'assistant_id' => 'required|exists:users,id',
            'score' => 'required|numeric|min:0|max:10',
            'graded_at' => 'required|date|before_or_equal:today',
        ];
    }

    public function save()
    {
        $this->validate();

        Grade::create([
        'student_id'   => $this->student->id,
        'class_id'     => $this->classroom->id,
        'grade_type'   => $this->grade_type,
        'assignment_id'=> $this->grade_type === 'homework'
                            ? $this->assignment_id
                            : null,
        'score'        => $this->score,
        'assistant_id'   => $this->assistant_id,
        'graded_at'    => $this->graded_at,
        'feedback'     => $this->feedback,
    ]);

    session()->flash('success', 'Lưu điểm thành công');

    $this->reset(['score', 'assignment_id', 'feedback']);
    }

    public function render()
    {
        return view('assistant.grade-entry.create');
    }
}