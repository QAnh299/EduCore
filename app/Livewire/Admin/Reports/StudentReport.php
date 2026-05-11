<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Livewire\Component;
use App\Models\Grade;
use App\Models\Lesson;
class StudentReport extends Component
{
    public $student;

    public $class;

    public $progress = 0;

    public $avgScore = 0;

    public $submitRate = 0;

    public $attendanceCount = 0;

    public $notSubmittedAssignments = [];

    public $needSupport = false;

    public $classNames = [];

    public function mount($student)
    {
        $this->student = Student::with(['user', 'classrooms', 'quizResults'])
    ->findOrFail($student);

$this->classNames = $this->student->classrooms->pluck('name')->toArray();

$classIds = $this->student->classrooms->pluck('id');

// Lấy assignments của các lớp
$assignments = \App\Models\Assignment::whereIn('class_id', $classIds)->get();

// Thay assignmentSubmissions bằng grades
$submissions = \App\Models\Grade::where('student_id', $this->student->id)
    ->whereIn('class_id', $classIds)
    ->where('grade_type', 'homework')
    ->get();
        $this->attendanceCount = Attendance::where('student_id', $this->student->id)
            ->whereIn('class_id', $this->student->classrooms->pluck('id'))
            ->where('present', true)->count();
       
        $this->submitRate = $assignments->count() > 0
            ? round($submissions->count() / $assignments->count() * 100)
            : 0;
//điểm trung bình
            //điểm trung bình
        $grades = Grade::where('student_id', $this->student->id)
    ->whereIn('class_id', $classIds)
    ->get();

$homeworkAvg = $grades
    ->where('grade_type', 'homework')
    ->sum('score') ?? 0;

$minitestAvg = $grades
    ->where('grade_type', 'minitest')
    ->sum('score') ?? 0;

$monthlyExamAvg = $grades
    ->where('grade_type', 'monthly_exam')
    ->sum('score') ?? 0;

$this->avgScore = round(
    ($homeworkAvg * 0.1) +
    ($minitestAvg * 0.3) +
    ($monthlyExamAvg * 0.6),
    4
);
        // Tính tiến độ học tập dựa trên lesson_user
        $user = $this->student->user;
        $lessonIds = \App\Models\Lesson::whereIn('classroom_id', $this->student->classrooms->pluck('id'))->pluck('id');
        $completedLessons = $user->lessons()->whereIn('lesson_id', $lessonIds)->whereNotNull('lesson_user.completed_at')->count();
        $totalLessons = $lessonIds->count();
        $this->progress = $totalLessons > 0 ? round($completedLessons / $totalLessons * 100) : 0;

        $this->notSubmittedAssignments = $assignments->filter(function ($a) use ($submissions) {
            return ! $submissions->where('assignment_id', $a->id)->count();
        });
        $this->needSupport = $this->avgScore < 5 || $this->submitRate < 60 || $this->progress < 60;
    }

    public function render()
    {
        return view('admin.reports.student-report', [
            'student' => $this->student,
            'classNames' => $this->classNames,
            'progress' => $this->progress,
            'avgScore' => $this->avgScore,
            'submitRate' => $this->submitRate,
            'attendanceCount' => $this->attendanceCount,
            'notSubmittedAssignments' => $this->notSubmittedAssignments,
            'needSupport' => $this->needSupport,
        ]);
    }
}
