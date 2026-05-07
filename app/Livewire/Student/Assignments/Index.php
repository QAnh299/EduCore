<?php

namespace App\Livewire\Student\Assignments;

use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filterStatus = 'all'; // all, submitted, unsubmitted

    public $filterClassroom = '';

    public $filterTeacher = '';

    public $search = '';

    public $filterTimeRange = 'all';

    public $filterDateFrom = '';

    public $filterDateTo = '';

    protected $queryString = [
        'filterStatus' => ['except' => 'all'],
        'filterClassroom' => ['except' => ''],
        'filterTeacher' => ['except' => ''],
        'filterTimeRange' => ['except' => 'all'],
        'filterDateFrom' => ['except' => ''],
        'filterDateTo' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterClassroom()
    {
        $this->resetPage();
    }

    public function updatingFilterTeacher()
    {
        $this->resetPage();
    }

    public function updatingFilterTimeRange()
    {
        $this->resetPage();

        if ($this->filterTimeRange !== 'custom') {
            $this->filterDateFrom = '';
            $this->filterDateTo = '';
        }
    }

    public function updatingFilterDateFrom()
    {
        $this->resetPage();
    }

    public function updatingFilterDateTo()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'filterStatus',
            'filterClassroom',
            'filterTeacher',
            'filterTimeRange',
            'filterDateFrom',
            'filterDateTo',
        ]);

        $this->resetPage();
    }

    public function getAssignmentsProperty()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return collect();
        }

        $query = Assignment::with([
            'classroom',
            'classroom.teachers',
            'grades' => function ($q) use ($student) {
                $q->where('student_id', $student->user_id);
            },
        ])
        ->whereHas('classroom.students', function ($q) use ($student) {
            $q->where('users.id', $student->user_id);
        });

        // Filter trạng thái
        if ($this->filterStatus === 'submitted') {

            $query->whereHas('grades', function ($q) use ($student) {
                $q->where('student_id', $student->user_id);
            });

        } elseif ($this->filterStatus === 'unsubmitted') {

            $query->whereDoesntHave('grades', function ($q) use ($student) {
                $q->where('student_id', $student->user_id);
            });
        }

        // Filter lớp
        if ($this->filterClassroom) {
            $query->where('class_id', $this->filterClassroom);
        }

        // Filter giáo viên
        if ($this->filterTeacher) {
            $query->whereHas('classroom.teachers', function ($q) {
                $q->where('users.id', $this->filterTeacher);
            });
        }

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter thời gian
        if ($this->filterTimeRange !== 'all') {

            $now = now();

            switch ($this->filterTimeRange) {

                case 'today':
                    $query->whereDate('deadline', $now->toDateString());
                    break;

                case 'week':
                    $query->whereBetween('deadline', [
                        $now->copy()->startOfWeek(),
                        $now->copy()->endOfWeek(),
                    ]);
                    break;

                case 'month':
                    $query->whereBetween('deadline', [
                        $now->copy()->startOfMonth(),
                        $now->copy()->endOfMonth(),
                    ]);
                    break;

                case 'custom':

                    if ($this->filterDateFrom) {
                        $query->whereDate('deadline', '>=', $this->filterDateFrom);
                    }

                    if ($this->filterDateTo) {
                        $query->whereDate('deadline', '<=', $this->filterDateTo);
                    }

                    break;
            }
        }

        return $query
            ->orderBy('deadline', 'desc')
            ->paginate(10);
    }

    public function getClassroomsProperty()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return collect();
        }

        return $student->user
            ->enrolledClassrooms()
            ->with('teachers')
            ->get();
    }

    public function getTeachersProperty()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return collect();
        }

        return $student->user
            ->enrolledClassrooms()
            ->with('teachers')
            ->get()
            ->pluck('teachers')
            ->flatten()
            ->unique('id');
    }

    // Đã nộp = đã có điểm/grade
    public function isSubmitted($assignment)
    {
        return $assignment->grades->isNotEmpty();
    }

    // Lấy điểm
    public function getScore($assignment)
    {
        $grade = $assignment->grades->first();

        return $grade?->score;
    }

    // Lấy nhận xét
    public function getFeedback($assignment)
    {
        $grade = $assignment->grades->first();

        return $grade?->feedback;
    }

    public function render()
    {
        return view('student.assignments.index', [
            'assignments' => $this->assignments,
            'classrooms' => $this->classrooms,
            'teachers' => $this->teachers,
        ]);
    }
}