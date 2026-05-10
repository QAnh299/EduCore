<?php

namespace App\Livewire\Teacher\GradeEntry;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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
        $this->reset([
            'search',
            'classroomFilter',
        ]);

        $this->resetPage();
    }

    /**
     * Lấy xếp hạng toàn bộ học viên
     */
    public function getStudentRank($studentId)
    {
        $allStudents = User::query()
            ->where('role', 'student')

            ->leftJoin(
                'grades','grades.student_id','=','users.id'
            )

            ->select(
                'users.id','users.name',
                DB::raw('ROUND(AVG(grades.score), 1) as average_score')
            )

            ->groupBy('users.id','users.name')
        ->havingRaw('average_score IS NOT NULL')
            ->orderByDesc('average_score')
            ->orderBy('users.name')

            ->get();

        foreach ($allStudents as $index => $student) {

            if ($student->id == $studentId) {
                return $index + 1;
            }
        }

        return null;
    }

    public function render()
    {
        $classrooms = Classroom::orderBy('name')->get();

        $students = User::query()

            ->where('role', 'student')

            ->leftJoin(
                'grades',
                'grades.student_id',
                '=',
                'users.id'
            )

            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('ROUND(AVG(grades.score), 1) as average_score')
            )

            ->with('classrooms')

            ->when($this->search, function ($query) {

                $query->where(
                    'users.name',
                    'like',
                    '%' . $this->search . '%'
                );
            })

            ->when($this->classroomFilter, function ($query) {

                $query->whereHas('classrooms', function ($q) {

                    $q->where(
                        'classrooms.id',
                        $this->classroomFilter
                    );
                });
            })

            ->groupBy(
                'users.id',
                'users.name',
                'users.email'
            )

            ->orderByDesc('average_score')
            ->orderBy('users.name')

            ->paginate(10);

        return view('teacher.grade-entry.index', [
            'students' => $students,
            'classrooms' => $classrooms,
        ]);
    }
}