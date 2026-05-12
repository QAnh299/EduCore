<?php

namespace App\Livewire\Teacher\Quizzes;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterClass = '';
    public $filterStatus = '';

    // Thêm property này
    public $classrooms = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'filterClass' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    public function mount()
    {
        $user = Auth::user();

    // Lấy danh sách lớp giáo viên dạy
    $this->classrooms = DB::table('classrooms')
        ->join('class_user', 'classrooms.id', '=', 'class_user.class_id')
        ->where('class_user.user_id', $user->id)
        ->where('class_user.role', 'teacher')
        ->select('classrooms.*')
        ->orderBy('classrooms.name')
        ->get();
    }
    public function resetFilters()
{
    $this->reset(['search', 'filterClass', 'filterStatus']);

    $this->resetPage();

    return redirect()->route('teacher.quizzes.index');
}

    
    public function deleteQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $teacherClassIds = Auth::user()->teachingClassrooms->pluck('id');

        if (! $teacherClassIds->contains($quiz->class_id)) {
            session()->flash('error', 'Bạn không có quyền xóa bài kiểm tra này.');
            return;
        }

        $quiz->delete();
        session()->flash('message', 'Bài kiểm tra đã được xóa thành công.');
    }

    public function render()
    {
        $user = Auth::user();
        $teacherClassIds = $user->teachingClassrooms->pluck('id');

        $quizzes = Quiz::query()
            ->with(['classroom'])
            ->whereIn('class_id', $teacherClassIds)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                      ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterClass, function ($query) {
                $query->where('class_id', $this->filterClass);
            })
            ->when($this->filterStatus, function ($query) {
                if ($this->filterStatus === 'active') {
                    $query->where('deadline', '>', now());
                } elseif ($this->filterStatus === 'expired') {
                    $query->where('deadline', '<=', now());
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('teacher.quizzes.index', [
            'quizzes' => $quizzes,
            'classrooms' => $this->classrooms,   // Sử dụng property
        ]);
    }
}