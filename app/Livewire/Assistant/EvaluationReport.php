<?php

namespace App\Livewire\Assistant;

use App\Models\Classroom;
use App\Models\Evaluation;
use App\Models\EvaluationQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationReport extends Component
{
    use WithPagination;

    public $classroomId = '';

    public $selectedEvaluation = null;

    public $roundId = '';

    protected $queryString = ['classroomId', 'roundId'];

    public function mount()
    {
        // nothing
    }

    public function loadEvaluations()
    {
        $this->resetPage();
    }

    public function showEvaluationDetail(int $evaluationId)
    {
        $this->selectedEvaluation = Evaluation::with('student.user')->find($evaluationId);
    }

    public function closeEvaluationDetail()
    {
        $this->selectedEvaluation = null;
    }

    public function render()
    {
        $assistantId = Auth::id();

        // Lấy danh sách lớp mà giáo viên này đang dạy (từ bảng class_user, role = 'assistant')
        $assistantClassroomIds = DB::table('class_user')
            ->where('user_id', $assistantId)
            ->where('role', 'assistant')
            ->pluck('class_id')
            ->toArray();

        // Danh sách lớp cho dropdown chỉ gồm lớp giáo viên dạy
        $classrooms = Classroom::whereIn('id', $assistantClassroomIds)->get();

        // Nếu classroomId không thuộc các lớp giáo viên dạy, reset về rỗng
        if ($this->classroomId && ! in_array((int) $this->classroomId, $assistantClassroomIds, true)) {
            $this->classroomId = '';
        }

        $query = Evaluation::with(['student.user']);

        // Chỉ lấy đánh giá của học viên thuộc các lớp giáo viên dạy
        $query->whereHas('student.user.enrolledClassrooms', function ($q) use ($assistantClassroomIds) {
            $q->whereIn('classrooms.id', $assistantClassroomIds);
        });

        // Lọc theo lớp cụ thể nếu được chọn
        if ($this->classroomId) {
            $classroomId = (int) $this->classroomId;
            $query->whereHas('student.user.enrolledClassrooms', function ($q) use ($classroomId) {
                $q->where('classrooms.id', $classroomId);
            });
        }

        // Lọc theo đợt đánh giá
        if ($this->roundId) {
            $query->where('evaluation_round_id', (int) $this->roundId);
        }

        $evaluations = $query->orderBy('created_at', 'desc')->paginate(10);

        // Lấy danh sách đợt có dữ liệu trong phạm vi lớp giáo viên dạy
        $roundOptions = Evaluation::query()
            ->whereHas('student.user.enrolledClassrooms', function ($q) use ($assistantClassroomIds) {
                $q->whereIn('classrooms.id', $assistantClassroomIds);
            })
            ->select('evaluation_round_id')
            ->distinct()
            ->pluck('evaluation_round_id');

        $rounds = \App\Models\EvaluationRound::whereIn('id', $roundOptions)
            ->orderBy('start_date', 'desc')
            ->get();

        // Tính điểm trung bình trên trang hiện tại
        $avgassistant = $evaluations->getCollection()->avg(function ($eva) {
            return $eva->getassistantAverageRating();
        });
        $avgCourse = $evaluations->getCollection()->avg(function ($eva) {
            return $eva->getCourseAverageRating();
        });
        $avgPersonal = $evaluations->getCollection()->avg('personal_satisfaction');

        $questions = EvaluationQuestion::ordered()->get();

        return view('assistant.evaluation-report', [
            'evaluations' => $evaluations,
            'classrooms' => $classrooms,
            'questions' => $questions,
            'avgassistant' => $avgassistant ?: 0,
            'avgCourse' => $avgCourse ?: 0,
            'avgPersonal' => $avgPersonal ?: 0,
            'total' => $evaluations->total(),
            'rounds' => $rounds,
        ]);
    }
}
