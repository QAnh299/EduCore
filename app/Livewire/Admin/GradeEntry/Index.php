<?php

namespace App\Livewire\Admin\GradeEntry;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Grade;
class Index extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $classroomFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'classroomFilter' => ['except' => ''],
    ];
// Reset về page 1 khi filter thay đổi
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedClassroomFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'classroomFilter']);
        $this->resetPage();
    }
    public function updatedFilter()
    {
    $this->resetPage();
    }
    public function getGradesProperty()
    {
     return Grade::query()
        ->where('student_id', $this->student->id)
        ->when($this->filter !== 'all', function ($q) {
            $q->where('grade_type', $this->filter);
        })
        ->orderByDesc('graded_at')
        ->paginate(10);
    }
    public function getGradesCountProperty()
    {
        
        return Grade::query()
        ->where('student_id', $this->student->id)
        ->when($this->filter !== 'all', function ($q) {
            $q->where('grade_type', $this->filter);
        })
        ->count();
    }

    public function render()
    {
        $classrooms = Classroom::orderBy('name')->get();
        $students = User::query()
            ->where('role', 'student')   // chỉ lấy student
            ->with('classrooms') // eager loading
            
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->with('classrooms') // eager loading

            ->when($this->classroomFilter, function ($query) {
                $query->whereHas('classrooms', function ($q) {
                    $q->where('classrooms.id', $this->classroomFilter);
                });
            })

            ->orderBy('name')
            ->paginate(10);

        return view('admin.grade-entry.index', [
            'students' => $students,
            'classrooms' => $classrooms,
        ]);
    }
}
