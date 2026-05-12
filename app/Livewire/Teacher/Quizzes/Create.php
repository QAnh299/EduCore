<?php

namespace App\Livewire\Teacher\Quizzes;

use App\Models\Classroom;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $title = '';
    public $description = '';
    public $class_id = '';
    public $deadline = '';
    public $time_limit = '';

    public $questions = [];

    public $currentQuestion = [
        'question' => '',
        'type' => 'multiple_choice',
        'options' => ['', '', '', ''],
        'correct_answer' => '',
        'score' => 1,
        'audio' => null,
    ];

    public $editingIndex = null;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'class_id' => 'required|exists:classrooms,id',
        'deadline' => 'nullable|date|after:now',
        'time_limit' => 'nullable|integer|min:1|max:480',
        'questions' => 'required|array|min:1',
    ];

    // Messages giữ nguyên hoặc rút gọn nếu bạn muốn
    protected $messages = [
        'title.required' => 'Vui lòng nhập tiêu đề bài kiểm tra.',
        'class_id.required' => 'Vui lòng chọn lớp học.',
        'questions.min' => 'Bài kiểm tra phải có ít nhất một câu hỏi.',
        // ... bạn có thể giữ lại các message khác nếu cần
    ];

    public function addQuestion()
    {
        $this->validate([
            'currentQuestion.question' => 'required|min:3',
            'currentQuestion.type' => 'required|in:multiple_choice',
            'currentQuestion.score' => 'required|integer|min:1|max:10',
        ]);

        if ($this->currentQuestion['type'] === 'multiple_choice') {
            $this->validate([
                'currentQuestion.options' => 'required|array|min:2',
                'currentQuestion.options.*' => 'required|min:1',
                'currentQuestion.correct_answer' => 'required|min:1',
            ]);
        }

        if ($this->editingIndex !== null) {
            $this->questions[$this->editingIndex] = $this->currentQuestion;
            $this->resetCurrentQuestion();
            session()->flash('message', 'Câu hỏi đã được cập nhật.');
        } else {
            $this->questions[] = $this->currentQuestion;
            $this->resetCurrentQuestion();
            session()->flash('message', 'Câu hỏi đã được thêm thành công.');
        }
    }

    public function removeQuestion($index)
    {
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
        session()->flash('message', 'Câu hỏi đã được xóa.');
    }

    public function moveQuestionUp($index)
    {
        if ($index > 0) {
            $temp = $this->questions[$index];
            $this->questions[$index] = $this->questions[$index - 1];
            $this->questions[$index - 1] = $temp;
        }
    }

    public function moveQuestionDown($index)
    {
        if ($index < count($this->questions) - 1) {
            $temp = $this->questions[$index];
            $this->questions[$index] = $this->questions[$index + 1];
            $this->questions[$index + 1] = $temp;
        }
    }

    public function addOption()
    {
        $this->currentQuestion['options'][] = '';
    }

    public function removeOption($index)
    {
        $removedOption = $this->currentQuestion['options'][$index] ?? '';
        unset($this->currentQuestion['options'][$index]);
        $this->currentQuestion['options'] = array_values($this->currentQuestion['options']);

        if ($removedOption === $this->currentQuestion['correct_answer']) {
            $this->currentQuestion['correct_answer'] = '';
        }
    }

    public function resetCurrentQuestion()
    {
        $this->currentQuestion = [
            'question' => '',
            'type' => 'multiple_choice',
            'options' => ['', '', '', ''],
            'correct_answer' => '',
            'score' => 1,
            'audio' => null,
        ];
        $this->editingIndex = null;
    }

    public function editQuestion($index)
    {
        if (!isset($this->questions[$index])) return;

        $this->currentQuestion = $this->questions[$index];
        $this->editingIndex = $index;
    }

    public function save()
    {
        $this->validate();

        try {
            $quiz = Quiz::create([
                'title' => $this->title,
                'description' => $this->description,
                'class_id' => $this->class_id,
                'deadline' => $this->deadline ? now()->parse($this->deadline) : null,
                'time_limit' => $this->time_limit ? (int) $this->time_limit : null,
                'questions' => $this->questions,
            ]);

            session()->flash('message', 'Bài kiểm tra đã được tạo thành công.');

            return redirect()->route('teacher.quizzes.show', $quiz);
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $classrooms = Classroom::whereHas('teachers', function ($query) {
            $query->where('users.id', Auth::id());
        })->orderBy('name')->get();

        return view('teacher.quizzes.create', [
            'classrooms' => $classrooms,
        ]);
    }
}