<?php

namespace App\Livewire\Admin\GradeEntry;

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
    public $teacher_id = null;
    public $score;
    public $feedback;
    public $graded_at;

    public $assignments;
    public $teachers;

    public function mount(User $student)
    {
        $this->student = $student->load('classrooms');

        $this->classroom = $this->student->classrooms->first();

        if (!$this->classroom) {
            abort(404, 'Học viên chưa được gán lớp');
        }

        $this->graded_at = now()->format('Y-m-d');

        $this->assignments = collect();
        $this->teachers = collect();

        $this->loadTeachers();
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

    public function loadTeachers()
    {
        $this->teachers = $this->classroom
            ->users()
            ->wherePivot('role', 'teacher')
            ->get();
    }

    protected function rules()
    {
        return [
            'grade_type' => 'required',
            'assignment_id' => 'required_if:type,homework|nullable|exists:assignments,id',
            'teacher_id' => 'required|exists:users,id',
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
        'teacher_id'   => $this->teacher_id,
        'graded_at'    => $this->graded_at,
        'feedback'     => $this->feedback,
    ]);

    session()->flash('success', 'Lưu điểm thành công');

    $this->reset(['score', 'assignment_id', 'feedback']);
    }

    public function render()
    {
        return view('admin.grade-entry.create');
    }
}