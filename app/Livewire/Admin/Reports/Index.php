<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Livewire\Component;
use App\Models\Grade;
use App\Models\Lesson;

class Index extends Component
{
    public $selectedClass = '';

    public $selectedStudent = '';

    public $classrooms = [];

    public $students = [];

    public $reportData = [];

    public function mount()
    {
        $this->classrooms = Classroom::all();
        $this->students = Student::with('user')->get();
    }

    public function render()
{
    $query = Student::with([
        'user',
        'classrooms',
        'quizResults.quiz'
    ]);

    if ($this->selectedClass) {
        $query->whereHas('classrooms', function ($q) {
            $q->where('id', $this->selectedClass);
        });
    }

    if ($this->selectedStudent) {
        $query->where('id', $this->selectedStudent);
    }

    $students = $query->get();
    $reportData = [];

    foreach ($students as $student) {

        $classNames = $student->classrooms->pluck('name')->toArray();

        /* XÁC ĐỊNH CLASS IDS */

        if ($this->selectedClass) {

            $class = $student->classrooms
                ->where('id', $this->selectedClass)
                ->first();

            if (!$class) {
                continue;
            }

            $classIds = collect([$class->id]);

        } else {

            $classIds = $student->classrooms->pluck('id');

            if ($classIds->isEmpty()) {
                continue;
            }
        }

        /* -------- BÀI TẬP -------- */

        $assignments = Assignment::whereIn('class_id', $classIds)->get();

        $totalAssignments = $assignments->count();


        /* -------- BÀI ĐÃ NỘP (TỪ GRADES) -------- */

        $submissions = Grade::where('student_id', $student->id)
            ->whereIn('class_id', $classIds)
            ->where('grade_type', 'homework')
            ->whereNotNull('assignment_id')
            ->distinct()
            ->count('assignment_id');


        /* -------- ĐIỂM DANH -------- */

        $attendanceCount = Attendance::where('student_id', $student->id)
            ->whereIn('class_id', $classIds)
            ->where('present', 1)
            ->count();


        /* -------- QUIZ -------- */

        $quizResults = $student->quizResults->filter(function ($qr) use ($classIds) {
            return $qr->quiz && $classIds->contains($qr->quiz->class_id);
        });

        $avgScore = $quizResults->avg('score') ?? 0;


        /* -------- PROGRESS LESSON -------- */

        $userModel = $student->user;

        $lessonIds = Lesson::whereIn('classroom_id', $classIds)
            ->pluck('id');

        $completedLessons = $userModel->lessons()
            ->whereIn('lesson_id', $lessonIds)
            ->whereNotNull('lesson_user.completed_at')
            ->count();

        $totalLessons = $lessonIds->count();

        $progress = $totalLessons > 0
            ? round($completedLessons / $totalLessons * 100)
            : 0;


        /* -------- TỶ LỆ NỘP BÀI -------- */

        $submitRate = $totalAssignments > 0
            ? round($submissions / $totalAssignments * 100)
            : 0;


        /* -------- CẢNH BÁO -------- */

        $needSupport =
            $avgScore < 5 ||
            $submitRate < 60 ||
            $progress < 60;


        /* -------- DATA -------- */

        $reportData[] = [
            'student_id' => $student->id,
            'student_name' => $student->user->name,
            'class_names' => $classNames,
            'progress' => $progress,
            'avg_score' => round($avgScore, 2),
            'submit_rate' => $submitRate,
            'attendance_count' => $attendanceCount,
            'need_support' => $needSupport,
        ];
    }

    $this->reportData = $reportData;

    return view('admin.reports.index', [
        'classrooms' => $this->classrooms,
        'students' => $this->students,
        'reportData' => $this->reportData,
    ]);
}
}
