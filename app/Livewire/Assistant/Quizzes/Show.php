<?php

namespace App\Livewire\Assistant\Quizzes;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load(['classroom', 'results']);

        // Kiểm tra quyền xem
        $assistantClassIds = Auth::user()->teachingClassrooms->pluck('id');
        if (! $assistantClassIds->contains($this->quiz->class_id)) {
            session()->flash('error', 'Bạn không có quyền xem bài kiểm tra này.');

            return redirect()->route('assistant.quizzes.index');
        }
    }

    public function render()
    {
        $questions = $this->quiz->questions ?? [];
        $results = $this->quiz->results()->with('student.user')->get();

        return view('assistant.quizzes.show', [
            'questions' => $questions,
            'results' => $results,
        ]);
    }
}
