<?php

namespace App\Livewire\Teacher\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $classroomFilter = '';

    public $classrooms = [];

    public $overviewStats = [];

    public $recentAssignments = [];

    public $selectedMonth;

    public $selectedYear;

    public function mount()
    {
        $this->classrooms = Classroom::whereHas('teachers', function ($query) {

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

    public function updatedSearch()
    {
        $this->loadStats();
    }

    public function updatedClassroomFilter()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $classIds = collect($this->classrooms)->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Query CHUNG
        |--------------------------------------------------------------------------
        | Tất cả thống kê + danh sách bài tập
        | đều phải dùng cùng bộ lọc
        */

        $query = Assignment::with([
            'grades',
            'classroom'
        ])
        ->whereIn('class_id', $classIds)
        ->whereMonth('created_at', $this->selectedMonth)
        ->whereYear('created_at', $this->selectedYear);

        // tìm kiếm
        if ($this->search) {

            $query->where(
                'title',
                'like',
                '%' . $this->search . '%'
            );
        }

        // lọc lớp học
        if ($this->classroomFilter) {

            $query->where(
                'class_id',
                $this->classroomFilter
            );
        }

        $assignments = $query->get();

        /*
        |--------------------------------------------------------------------------
        | Tổng bài tập
        |--------------------------------------------------------------------------
        */

        $totalAssignments = $assignments->count();

        /*
        |--------------------------------------------------------------------------
        | Tổng bài chưa chấm
        |--------------------------------------------------------------------------
        */

        $ungradedAssignments = 0;

        /*
        |--------------------------------------------------------------------------
        | Tổng bài đã chấm
        |--------------------------------------------------------------------------
        */

        $completedAssignments = 0;

        foreach ($assignments as $assignment) {

            /*
            |--------------------------------------------------------------------------
            | Logic hệ thống:
            |--------------------------------------------------------------------------
            | Chỉ cần có ÍT NHẤT 1 điểm
            | => xem như bài đã chấm
            */

            $gradedCount = Grade::where(
                'assignment_id',
                $assignment->id
            )
            ->whereNotNull('score')
            ->count();

            if ($gradedCount > 0) {

                $completedAssignments++;

            } else {

                $ungradedAssignments++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Tỷ lệ hoàn thành
        |--------------------------------------------------------------------------
        */

        $completionRate = $totalAssignments > 0
            ? round(
                ($completedAssignments / $totalAssignments) * 100,
                1
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Gán dữ liệu thống kê
        |--------------------------------------------------------------------------
        */

        $this->overviewStats = [

            'total_assignments' => $totalAssignments,

            'ungraded_assignments' => $ungradedAssignments,

            'completion_rate' => $completionRate,
        ];

        /*
        |--------------------------------------------------------------------------
        | Bài tập gần đây
        |--------------------------------------------------------------------------
        */

        $this->recentAssignments = $assignments
            ->sortByDesc('created_at')
            ->take(10);
    }

    public function deleteAssignment($assignmentId)
    {
        try {

            $assignment = Assignment::findOrFail($assignmentId);

            // xóa file đính kèm
            if ($assignment->attachment_path) {

                Storage::disk('public')
                    ->delete($assignment->attachment_path);
            }

            // xóa video
            if ($assignment->video_path) {

                Storage::disk('public')
                    ->delete($assignment->video_path);
            }

            // xóa điểm
            Grade::where(
                'assignment_id',
                $assignment->id
            )->delete();

            // xóa bài tập
            $assignment->delete();

            session()->flash(
                'success',
                'Đã xóa bài tập thành công!'
            );

            $this->loadStats();

            $this->dispatch(
                'closeModal',
                modalId: 'deleteAssignmentModal' . $assignmentId
            );

        } catch (\Exception $e) {

            session()->flash(
                'error',
                'Có lỗi xảy ra: ' . $e->getMessage()
            );
        }
    }

    public function render()
    {
        $classIds = collect($this->classrooms)->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Query danh sách bài tập
        |--------------------------------------------------------------------------
        */

        $query = Assignment::with([
            'classroom'
        ])
        ->whereIn('class_id', $classIds)
        ->whereMonth('created_at', $this->selectedMonth)
        ->whereYear('created_at', $this->selectedYear);

        // tìm kiếm
        if ($this->search) {

            $query->where(
                'title',
                'like',
                '%' . $this->search . '%'
            );
        }

        // lọc lớp
        if ($this->classroomFilter) {

            $query->where(
                'class_id',
                $this->classroomFilter
            );
        }

        $assignments = $query
            ->latest()
            ->paginate(10);

        return view('teacher.assignments.index', [

            'assignments' => $assignments,

            'classrooms' => $this->classrooms,

            'overviewStats' => $this->overviewStats,

            'recentAssignments' => $this->recentAssignments,
        ]);
    }
}