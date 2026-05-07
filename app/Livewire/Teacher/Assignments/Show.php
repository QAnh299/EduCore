<?php

namespace App\Livewire\Teacher\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;

class Show extends Component
{
    public $assignment;
    public $classroom;
    public $students;
    public $assignmentId;
    public $scores = [];
    public $comments = [];

    public function mount($assignment)
    {
        $this->assignmentId = $assignment;

        $this->assignment = Assignment::with('classroom')->findOrFail($assignment);

        $this->classroom = $this->assignment->classroom;

        $this->students = $this->classroom
            ? $this->classroom->students
            : collect();
        // Load điểm cho mỗi học viên
         // load điểm cũ
    foreach ($this->students as $student) {

        $grade = Grade::where('assignment_id', $this->assignment->id)
            ->where('student_id', $student->id)
            ->first();

        $this->scores[$student->id] = $grade?->score;
        $this->comments[$student->id] = $grade?->feedback;
    }
    }
    /**
     * validate realtime khi nhập điểm
     */
    public function updatedScores($value, $key)
{
    $userId = $key;

    $student = $this->students->where('id', $userId)->first();

    $studentName = $student
        ? $student->name
        : 'Không xác định';

    if ($value === '' || $value === null) {
        return;
    }

    if (!is_numeric($value)) {

        session()->flash(
            'error',
            'Điểm của học viên "' . $studentName . '" phải là số!'
        );

        return;
    }

    $score = (float) $value;

    if ($score < 0 || $score > 10) {

        session()->flash(
            'error',
            'Điểm của học viên "' . $studentName . '" phải từ 0 đến 10!'
        );

        return;
    }

    if (strpos((string) $value, '.') !== false) {

        $decimal = strlen(substr(strrchr((string) $value, '.'), 1));

        if ($decimal > 1) {

            session()->flash(
                'error',
                'Điểm của học viên "' . $studentName . '" chỉ được tối đa 1 số thập phân!'
            );

            return;
        }
    }

    session()->forget('error');
}

    /**
     * Lưu điểm
     */
   public function updateScore()
{
    foreach ($this->scores as $userId => $score) {

        // lấy user
        $student = $this->students->where('id', $userId)->first();

        $studentName = $student
            ? $student->name
            : 'Không xác định';

        // validate rỗng
        if ($score === '' || $score === null) {
             Grade::where('assignment_id', $this->assignment->id)
        ->where('student_id', $userId)
        ->delete();

            continue;
        }

        // validate số
        if (!is_numeric($score)) {

            session()->flash(
                'error',
                'Điểm của học viên "' . $studentName . '" phải là số!'
            );

            return;
        }

        $score = (float) $score;

        // validate min max
        if ($score < 0 || $score > 10) {

            session()->flash(
                'error',
                'Điểm của học viên "' . $studentName . '" phải từ 0 đến 10!'
            );

            return;
        }

        // lưu DB
        Grade::updateOrCreate(
            [
                'assignment_id' => $this->assignment->id,
                'student_id' => $userId,
            ],
            [
                'class_id' => $this->classroom->id,
                'score' => $score,
                'feedback' => $this->comments[$userId] ?? null,
            ]
        );
    }

    session()->flash('success', 'Lưu điểm thành công!');
}

    /**
     * Lấy điểm
     */
    public function getScore($student)
    {
        $studentModel = Student::where('user_id', $student->id)->first();

        if (!$studentModel) {
            return null;
        }

        $grade = Grade::where('assignment_id', $this->assignment->id)
            ->where('student_id', $student->id)
            ->first();

        return $grade ? $grade->score : null;
    }

    /**
     * Trạng thái nộp
     */
    public function getSubmissionStatus($student)
{
    $grade = Grade::where('assignment_id', $this->assignment->id)
        ->where('student_id', $student->id)
        ->first();

    if ($grade && $grade->score !== null) {
        return [
            'status' => 'submitted',
            'label' => 'Đã nộp',
            'class' => 'bg-success',
        ];
    }

    return [
        'status' => 'not_submitted',
        'label' => 'Chưa nộp',
        'class' => 'bg-secondary',
    ];
}

    public function render()
    {
        return view('teacher.assignments.show');
    }
}