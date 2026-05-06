<?php

namespace App\Livewire\Assistant\MyClass;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedClassroom = null;

    public $showClassroomDetails = false;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Khởi tạo component
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function showClassroom($classroomId)
    {
        $this->selectedClassroom = Classroom::with(['students', 'lessons', 'assignments'])
            ->findOrFail($classroomId);
        $this->showClassroomDetails = true;
    }

    public function closeClassroomDetails()
    {
        $this->showClassroomDetails = false;
        $this->selectedClassroom = null;
    }

    public function render()
    {
        $assistant = Auth::user();

        $classrooms = Classroom::whereHas('users', function ($query) use ($assistant) {
            $query->where('user_id', $assistant->id);
                
        })
            ->with(['students', 'lessons', 'assignments'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('assistant.my-class.index', [
            'classrooms' => $classrooms,
            'assistant' => $assistant,
        ]);
    }
}
