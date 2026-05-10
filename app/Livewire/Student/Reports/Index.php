<?php

namespace App\Livewire\Student\Reports;

use App\Models\Grade;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /*
    |--------------------------------------------------------------------------
    | THỐNG KÊ
    |--------------------------------------------------------------------------
    */

    public $average = 0;

    public $rank = null;

    public $totalStudents = 0;

    public $attendancePresent = 0;

    public $attendanceAbsent = 0;

    /*
    |--------------------------------------------------------------------------
    | TAB
    |--------------------------------------------------------------------------
    */

    public $activeTab = 'assignments';

    public int $perPageAssignments = 10;

    public int $perPageQuizzes = 10;

    public int $perPageAttendances = 10;

    protected $queryString = [
        'activeTab' => ['except' => 'assignments'],
        'page' => ['except' => 1],
        'asPage' => ['except' => 1],
        'qrPage' => ['except' => 1],
        'atPage' => ['except' => 1],
    ];

    public function mount()
    {
        $this->calculateAverage();

        $this->calculateRank();

        $this->loadAttendanceStatistics();
    }

    /*
    |--------------------------------------------------------------------------
    | ĐIỂM TRUNG BÌNH
    |--------------------------------------------------------------------------
    */

    private function calculateAverage()
    {
        $homework = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'homework')
            ->avg('score');

        $minitest = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'minitest')
            ->avg('score');

        $exam = Grade::where('student_id', Auth::id())
            ->where('grade_type', 'monthly_exam')
            ->avg('score');

        $homework = $homework ?? 0;
        $minitest = $minitest ?? 0;
        $exam = $exam ?? 0;

        $this->average = round(
            ($homework * 0.1) +
            ($minitest * 0.3) +
            ($exam * 0.6),
            1
        );
    }

    /*
    |--------------------------------------------------------------------------
    | XẾP HẠNG THEO KHỐI
    |--------------------------------------------------------------------------
    */

    private function calculateRank()
    {
        $currentStudent = User::with('classrooms')
            ->find(Auth::id());

        if (
            !$currentStudent ||
            $currentStudent->classrooms->isEmpty()
        ) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Lấy khối hiện tại
        | Ví dụ:
        | Lớp 6A => 6
        |--------------------------------------------------------------------------
        */

        $currentClassroom = $currentStudent
            ->classrooms
            ->first();

        preg_match(
            '/\d+/',
            $currentClassroom->name,
            $matches
        );

        $currentGrade = $matches[0] ?? null;

        if (!$currentGrade) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Lấy học viên cùng khối
        |--------------------------------------------------------------------------
        */

        $students = User::where('role', 'student')
            ->with('classrooms')
            ->get()
            ->filter(function ($student) use ($currentGrade) {

                if ($student->classrooms->isEmpty()) {
                    return false;
                }

                $classroomName = $student
                    ->classrooms
                    ->first()
                    ->name;

                preg_match(
                    '/\d+/',
                    $classroomName,
                    $matches
                );

                $studentGrade = $matches[0] ?? null;

                return $studentGrade == $currentGrade;
            });

        $scores = [];

        foreach ($students as $student) {

            $homework = Grade::where('student_id', $student->id)
                ->where('grade_type', 'homework')
                ->avg('score');

            $minitest = Grade::where('student_id', $student->id)
                ->where('grade_type', 'minitest')
                ->avg('score');

            $exam = Grade::where('student_id', $student->id)
                ->where('grade_type', 'monthly_exam')
                ->avg('score');

            $homework = $homework ?? 0;
            $minitest = $minitest ?? 0;
            $exam = $exam ?? 0;

            $average = round(
                ($homework * 0.1) +
                ($minitest * 0.3) +
                ($exam * 0.6),
                1
            );

            if ($average > 0) {

                $scores[] = [
                    'id' => $student->id,
                    'name' => $student->name,
                    'average_score' => $average,
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Sort giảm dần theo điểm
        |--------------------------------------------------------------------------
        */

        usort($scores, function ($a, $b) {

            if (
                $a['average_score']
                ==
                $b['average_score']
            ) {
                return strcmp(
                    $a['name'],
                    $b['name']
                );
            }

            return $b['average_score']
                <=>
                $a['average_score'];
        });

        /*
        |--------------------------------------------------------------------------
        | Đồng điểm => cùng hạng
        |--------------------------------------------------------------------------
        */

        $rank = 1;

        $previousScore = null;

        foreach ($scores as $index => $student) {

            if (
                $previousScore !== null &&
                $student['average_score'] < $previousScore
            ) {
                $rank = $index + 1;
            }

            if ($student['id'] == Auth::id()) {

                $this->rank = $rank;

                break;
            }

            $previousScore = $student['average_score'];
        }

        $this->totalStudents = count($scores);
    }

    /*
    |--------------------------------------------------------------------------
    | THỐNG KÊ ĐIỂM DANH
    |--------------------------------------------------------------------------
    */

    private function loadAttendanceStatistics()
    {
        $student = Auth::user()->studentProfile;

        if (!$student) {
            return;
        }

        $attendances = Attendance::where(
            'student_id',
            $student->id
        )->get();

        /*
        |--------------------------------------------------------------------------
        | present / absent
        |--------------------------------------------------------------------------
        */

        $this->attendancePresent = $attendances
            ->where('present', true)
            ->count();

        $this->attendanceAbsent = $attendances
            ->where('present', false)
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | TAB
    |--------------------------------------------------------------------------
    */

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;

        if ($tab === 'assignments') {

            $this->resetPage('asPage');

        } elseif ($tab === 'quizzes') {

            $this->resetPage('qrPage');

        } elseif ($tab === 'attendance') {

            $this->resetPage('atPage');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $user = Auth::user();

        $student = $user->studentProfile;

        Log::info('Student Reports Debug', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'student_id' => $student?->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Nếu chưa có student profile
        |--------------------------------------------------------------------------
        */

        if (
            !$student &&
            $user->role === 'student'
        ) {

            $student = \App\Models\Student::create([
                'user_id' => $user->id,
                'status' => 'active',
                'joined_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TAB BÀI TẬP
        |--------------------------------------------------------------------------
        */

        $assignmentSubmissionsPaginated = Grade::with([
                'assignment',
                'assignment.classroom'
            ])
            ->where('student_id', Auth::id())
            ->where('grade_type', 'homework')
            ->latest('graded_at')
            ->paginate(
                $this->perPageAssignments,
                ['*'],
                'asPage'
            );

        /*
        |--------------------------------------------------------------------------
        | TAB KIỂM TRA
        |--------------------------------------------------------------------------
        */

        $quizResultsPaginated = Grade::with([
                'assignment',
                'teacher'
            ])
            ->where('student_id', Auth::id())

            ->whereIn('grade_type', [
                'minitest',
                'monthly_exam'
            ])

            ->latest('graded_at')

            ->paginate(
                $this->perPageQuizzes,
                ['*'],
                'qrPage'
            );

        /*
        |--------------------------------------------------------------------------
        | TAB ĐIỂM DANH
        |--------------------------------------------------------------------------
        */

        $attendancesPaginated = Attendance::with([
                'classroom'
            ])
            ->where(
                'student_id',
                $student->id
            )
            ->latest('date')
            ->paginate(
                $this->perPageAttendances,
                ['*'],
                'atPage'
            );

        return view('student.reports.index', [

            'assignmentSubmissionsPaginated'
                =>
                $assignmentSubmissionsPaginated,

            'quizResultsPaginated'
                =>
                $quizResultsPaginated,

            'attendancesPaginated'
                =>
                $attendancesPaginated,
        ]);
    }
}