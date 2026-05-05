<?php

namespace App\Livewire\Assistant\Lessons;

use App\Models\Classroom;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $lesson;

    public function mount(Lesson $lesson)
    {
        // Chỉ lấy các lớp học mà giáo viên hiện tại đã tham gia
        $classrooms = Classroom::whereHas('assistants', function ($query) {
            $query->where('users.id', Auth::id());
        })->orderBy('name')->get();

        // Kiểm tra xem assistant có quyền xem bài học này không
        $this->lesson = Lesson::whereIn('classroom_id', $classrooms->pluck('id'))
            ->with('classroom')
            ->findOrFail($lesson->id);
    }

    public function render()
    {
        return view('assistant.lessons.show');
    }
}
