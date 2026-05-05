<?php

namespace App\Livewire\assistant\Assignments;

use App\Models\Assignment;
//use App\Models\AssignmentSubmission;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    public $statusFilter = '';

    public $classroomFilter = '';

    public $classrooms = [];

    public $overviewStats = [];

    public $topClasses = [];

    public $recentAssignments = [];

    public $topStudents = [];

    public $selectedMonth;

    public $selectedYear;

    public function mount()
    {
        $user = Auth::user();
        // Chỉ lấy các lớp học mà giáo viên hiện tại đã tham gia
        $this->classrooms = Classroom::whereHas('assistants', function ($query) {
            $query->where('users.id', Auth::id());
        })->orderBy('name')->get();
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;
        $this->loadStats();
    }

    public function updatedSelectedMonth()
    {
        $this->loadStats();
    }

    public function updatedSelectedYear()
    {
        $this->loadStats();
    }

    public function loadStats()
{
    $month = $this->selectedMonth;
    $year = $this->selectedYear;
    $user = Auth::user();

    $query = Assignment::query();

    if ($user->role === 'assistant') {
        $classIds = collect($this->classrooms)->pluck('id');
        $query->whereIn('class_id', $classIds);
    }

    $assignments = $query->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    $assignmentIds = $assignments->pluck('id');

    // Lấy dữ liệu từ bảng grades
    $grades = Grade::whereIn('assignment_id', $assignmentIds)
        ->where('grade_type', 'homework')
        ->get();

    $totalAssignments = $assignments->count();
    $totalClasses = $assignments->pluck('class_id')->unique()->count();

    $totalSubmissions = $grades->count();

    // Vì bảng grades không có submitted_at nên coi có grade = đã nộp
    $onTimeSubmissions = $grades->filter(function ($g) {
        return $g->assignment && $g->assignment->deadline &&
               $g->created_at <= $g->assignment->deadline;
    })->count();

    $submissionRate = $totalAssignments > 0
        ? round($totalSubmissions / $totalAssignments * 100, 1)
        : 0;

    $onTimeRate = $totalSubmissions > 0
        ? round($onTimeSubmissions / $totalSubmissions * 100, 1)
        : 0;

    $this->overviewStats = [
        'total_assignments' => $totalAssignments,
        'total_classes' => $totalClasses,
        'total_submissions' => $totalSubmissions,
        'submission_rate' => $submissionRate,
        'on_time_rate' => $onTimeRate,
    ];

    // Top lớp nhiều bài tập
    $this->topClasses = $assignments->groupBy('class_id')->map(function ($items, $classId) {
        return [
            'classroom' => Classroom::find($classId),
            'total_assignments' => $items->count(),
        ];
    })->sortByDesc('total_assignments')->take(5);

    // Bài tập gần đây
    $this->recentAssignments = $assignments->sortByDesc('created_at')->take(10);

    // Top học viên nộp bài đúng hạn
    $studentStats = $grades->groupBy('student_id')->map(function ($items, $studentId) {

        $onTime = $items->filter(function ($g) {
            return $g->assignment && $g->assignment->deadline &&
                   $g->created_at <= $g->assignment->deadline;
        })->count();

        $student = Student::find($studentId);

        return [
            'student' => $student ? $student->user : null,
            'total_submissions' => $items->count(),
            'on_time' => $onTime,
            'on_time_rate' => $items->count() > 0
                ? round($onTime / $items->count() * 100, 1)
                : 0,
        ];

    })->sortByDesc('on_time_rate')->take(5);

    $this->topStudents = $studentStats;
}
    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->classroomFilter = '';
    }

    public function deleteAssignment($assignmentId)
    {
        try {
            $assignment = \App\Models\Assignment::findOrFail($assignmentId);

            // Xóa file đính kèm nếu có
            if ($assignment->attachment_path) {
                Storage::disk('public')->delete($assignment->attachment_path);
            }
            if ($assignment->video_path) {
                Storage::disk('public')->delete($assignment->video_path);
            }

            // Xóa các bài nộp liên quan (phòng khi DB chưa bật cascade)
            if (method_exists($assignment, 'submissions')) {
                $assignment->submissions()->delete();
            }

            $assignment->delete();

            session()->flash('success', 'Đã xóa bài tập thành công!');
            $this->loadStats();

            // Đóng modal bằng JavaScript
            $this->dispatch('closeModal', modalId: 'deleteAssignmentModal'.$assignmentId);

        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi xóa bài tập: '.$e->getMessage());
        }
    }

    public function render()
    {
        $user = Auth::user();
        $classIds = collect($this->classrooms)->pluck('id');
        $query = Assignment::with(['classroom', 'submissions'])
            ->whereIn('class_id', $classIds);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }
        if ($this->statusFilter === 'active') {
            $query->where('deadline', '>', now());
        } elseif ($this->statusFilter === 'overdue') {
            $query->where('deadline', '<', now());
        }
        if ($this->classroomFilter) {
            $query->where('class_id', $this->classroomFilter);
        }
        $assignments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('assistant.assignments.index', [
            'assignments' => $assignments,
            'classrooms' => $this->classrooms,
            'overviewStats' => $this->overviewStats,
            'topClasses' => $this->topClasses,
            'recentAssignments' => $this->recentAssignments,
            'topStudents' => $this->topStudents,
        ]);
    }
}
