<?php

namespace App\Livewire\Teacher\GradeEntry;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Grade;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $classroomFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'classroomFilter' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedClassroomFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'classroomFilter']);
        $this->resetPage();
    }

    /**
     * Tính điểm tổng kết cho một học viên (không tính Quiz).
     * Công thức: BTVN * 10% + Minitest * 30% + Cuối tháng * 60%
     */
    public function calculateAverage(int $studentId): float
    {
        $homework = Grade::where('student_id', $studentId)
            ->where('grade_type', 'homework')
            ->avg('score') ?? 0;

        $minitest = Grade::where('student_id', $studentId)
            ->where('grade_type', 'minitest')
            ->avg('score') ?? 0;

        $exam = Grade::where('student_id', $studentId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score') ?? 0;

        $hasGrades = Grade::where('student_id', $studentId)
            ->whereIn('grade_type', ['homework', 'minitest', 'monthly_exam'])
            ->exists();

        if (!$hasGrades) {
            return 0;
        }

        return round($homework * 0.1 + $minitest * 0.3 + $exam * 0.6, 2);
    }

    /**
     * Tính xếp hạng của học viên dựa trên điểm tổng kết.
     */
    public function calculateRank(int $studentId): array
    {
        $allStudents = User::where('role', 'student')->pluck('id');

        $scores = [];
        foreach ($allStudents as $id) {
            $scores[$id] = $this->calculateAverage($id);
        }

        arsort($scores);
        $rank = array_search($studentId, array_keys($scores));

        return [
            'rank' => ($rank !== false) ? $rank + 1 : '-',
            'total' => count($scores),
        ];
    }

    public function render()
    {
        $classrooms = Classroom::orderBy('name')->get();
        $students = User::query()
            ->where('role', 'student')
            ->with('classrooms')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->classroomFilter, function ($query) {
                $query->whereHas('classrooms', function ($q) {
                    $q->where('classrooms.id', $this->classroomFilter);
                });
            })
            ->orderBy('name')
            ->paginate(10);

        return view('teacher.grade-entry.index', [
            'students' => $students,
            'classrooms' => $classrooms,
        ]);
    }
}
