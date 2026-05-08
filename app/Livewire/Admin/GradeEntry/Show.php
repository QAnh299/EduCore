<?php

namespace App\Livewire\Admin\GradeEntry;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Grade;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $student;
    public $filter = 'all';

    public function mount(User $student)
    {
        $this->student = $student;
    }

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function getGradesProperty()
    {
        return Grade::query()
            ->where('student_id', $this->student->id)
            ->when($this->filter !== 'all', function ($q) {
                $q->where('grade_type', $this->filter);
            })
            ->with(['teacher', 'assignment'])
            ->orderByDesc('graded_at')
            ->paginate(10);
    }

    public function getGradesCountProperty()
    {
        return Grade::query()
            ->where('student_id', $this->student->id)
            ->when($this->filter !== 'all', function ($q) {
                $q->where('grade_type', $this->filter);
            })
            ->count();
    }

    /**
     * Tính điểm tổng kết (không tính Quiz).
     * Công thức: TB(BTVN) * 10% + TB(Minitest) * 30% + TB(Cuối tháng) * 60%
     */
    public function getAverageScoreProperty(): float
    {
        $studentId = $this->student->id;

        $hasGrades = Grade::where('student_id', $studentId)
            ->whereIn('grade_type', ['homework', 'minitest', 'monthly_exam'])
            ->exists();

        if (!$hasGrades) {
            return 0;
        }

        $homework = Grade::where('student_id', $studentId)
            ->where('grade_type', 'homework')
            ->avg('score') ?? 0;

        $minitest = Grade::where('student_id', $studentId)
            ->where('grade_type', 'minitest')
            ->avg('score') ?? 0;

        $exam = Grade::where('student_id', $studentId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score') ?? 0;

        return round($homework * 0.1 + $minitest * 0.3 + $exam * 0.6, 2);
    }

    public function render()
    {
        return view('admin.grade-entry.show');
    }

    public function delete($id)
    {
        Grade::findOrFail($id)->delete();
        session()->flash('success', 'Đã xóa điểm thành công');
    }
}
