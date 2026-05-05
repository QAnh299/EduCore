<?php

namespace App\Livewire\Assistant\GradeEntry;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;

class Show extends Component
{
    public $student;
    public $filter = 'all';

    public function mount(User $student)
    {
        $this->student = $student;
    }

    public function getGradesProperty()
{
    return Grade::where('student_id', $this->student->id)
        ->when($this->filter !== 'all', function ($query) {
            $query->where('grade_type', $this->filter);
        })
        ->with(['assistant', 'assignment'])
        ->orderByDesc('graded_at')
        ->get();
}
    public function getGradesCountProperty()
    {
        return $this->grades->count();
    }
    public function render()
    {
        return view('assistant.grade-entry.show');
    }

    public function delete($id)
    {
        Grade::findOrFail($id)->delete();

        session()->flash('success', 'Đã xóa điểm thành công');
    }
}