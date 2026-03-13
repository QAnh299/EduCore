<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Classroom;
use Livewire\Component;

class ClassReport extends Component
{
    public $classroom;

    public $reportData = [];

    public function mount($classroom)
{
    $this->classroom = Classroom::findOrFail($classroom);

    $students = $this->classroom->students()
        ->with('studentProfile', 'studentProfile.quizResults')
        ->get();

    $assignments = Assignment::where('class_id', $this->classroom->id)->get();

    $reportData = [];

    foreach ($students as $user) {

        $student = $user->studentProfile;

        if (!$student) {
            continue;
        }

        // Lấy grades homework của sinh viên trong lớp
        $grades = Grade::where('student_id', $student->id)
            ->where('class_id', $this->classroom->id)
            ->where('grade_type', 'homework')
            ->get();

        // Điểm danh
        $attendanceCount = Attendance::where('student_id', $student->id)
            ->where('class_id', $this->classroom->id)
            ->where('present', true)
            ->count();

        // Kết quả quiz
        $quizResults = $student->quizResults;
        $avgScore = $quizResults->avg('score') ?? 0;

        // Tỷ lệ nộp bài
        $submitRate = $assignments->count() > 0
            ? round($grades->count() / $assignments->count() * 100)
            : 0;

        // Tiến độ học lesson
        $lessonIds = \App\Models\Lesson::where('classroom_id', $this->classroom->id)->pluck('id');

        $completedLessons = $user->lessons()
            ->whereIn('lesson_id', $lessonIds)
            ->whereNotNull('lesson_user.completed_at')
            ->count();

        $totalLessons = $lessonIds->count();

        $progress = $totalLessons > 0
            ? round($completedLessons / $totalLessons * 100)
            : 0;

        // Cần hỗ trợ
        $needSupport = $avgScore < 5 || $submitRate < 60 || $progress < 60;

        $reportData[] = [
            'student_id' => $student->id,
            'student_name' => $user->name,
            'progress' => $progress,
            'avg_score' => round($avgScore, 2),
            'submit_rate' => $submitRate,
            'attendance_count' => $attendanceCount,
            'need_support' => $needSupport,
        ];
    }

    $this->reportData = $reportData;
}
    public function render()
    {
        return view('admin.reports.class-report', [
            'classroom' => $this->classroom,
            'reportData' => $this->reportData,
        ]);
    }
}
