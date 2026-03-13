<?php

namespace App\Livewire\Student\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Submit extends Component
{
    use WithFileUploads;

    public Assignment $assignment;

    public $assignmentId;

    public $content = '';
    public $essay = '';

    public $imageFile;
    public $audioFile;
    public $videoFile;

    public $submissionType = 'text';

    protected function rules()
    {
        switch ($this->submissionType) {
            case 'text':
                return ['content' => 'required|string|max:10000'];

            case 'essay':
                return ['essay' => 'required|string|max:50000'];

            case 'image':
                return ['imageFile' => 'required|image|max:10240'];

            case 'audio':
                return ['audioFile' => 'required|file|mimes:mp3,wav,m4a|max:51200'];

            case 'video':
                return ['videoFile' => 'required|file|mimes:mp4,avi,mov|max:204800'];

            default:
                return [];
        }
    }

    public function mount($assignmentId)
    {
        $this->assignmentId = $assignmentId;

        $student = Auth::user()->student;

        if (!$student) {
            abort(403);
        }

        $this->assignment = Assignment::whereHas('classroom.students', function ($q) use ($student) {
            $q->where('users.id', $student->user_id);
        })->findOrFail($assignmentId);

        if ($this->assignment->deadline < now()) {
            session()->flash('error', 'Bài tập đã quá hạn');

            return redirect()->route('student.assignments.show', $assignmentId);
        }
    }

    public function getSubmissionStatus()
    {
        $student = Auth::user()->student;

        $submissions = Grade::where('assignment_id', $this->assignment->id)
            ->where('student_id', $student->id)
            ->where('grade_type', 'homework')
            ->get();

        $submittedTypes = $submissions->pluck('submission_type')->toArray();

        $requiredTypes = $this->assignment->types ?? [];

        $missingTypes = array_diff($requiredTypes, $submittedTypes);

        return [
            'submitted_types' => $submittedTypes,
            'required_types' => $requiredTypes,
            'missing_types' => $missingTypes
        ];
    }

    public function isTypeSubmitted($type)
    {
        $status = $this->getSubmissionStatus();

        return in_array($type, $status['submitted_types']);
    }

    public function submitAssignment()
    {
        $this->validate();

        $student = Auth::user()->student;

        if (!$student) {
            session()->flash('error', 'Không tìm thấy sinh viên');

            return;
        }

        $existing = Grade::where('assignment_id', $this->assignment->id)
            ->where('student_id', $student->id)
            ->where('submission_type', $this->submissionType)
            ->first();

        if ($existing) {
            session()->flash('error', 'Bạn đã nộp dạng này rồi');

            return;
        }

        $content = null;

        switch ($this->submissionType) {

            case 'text':
                $content = $this->content;
                break;

            case 'essay':
                $content = $this->essay;
                break;

            case 'image':
                $content = $this->imageFile->store('assignments/images', 'public');
                break;

            case 'audio':
                $content = $this->audioFile->store('assignments/audio', 'public');
                break;

            case 'video':
                $content = $this->videoFile->store('assignments/video', 'public');
                break;
        }

        Grade::create([
            'student_id' => $student->id,
            'assignment_id' => $this->assignment->id,
            'class_id' => $this->assignment->class_id,
            'grade_type' => 'homework',
            'submission_type' => $this->submissionType,
            'content' => $content,
            'score' => null
        ]);

        session()->flash('success', 'Nộp bài thành công');

        return redirect()->route('student.assignments.show', $this->assignmentId);
    }

    public function render()
    {
        return view('student.assignments.submit');
    }
}