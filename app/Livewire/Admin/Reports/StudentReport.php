<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Assignment;

class StudentReport extends Component
{
    public $student;
    public $classNames = [];
    public $avgScore = 0;
    public $submitRate = 0;
    public $attendanceCount = 0;
    public $totalAttendance = 0;
    public $attendanceRate = 0;
    public $uncheckedAssignments = [];

    // Thêm 2 thuộc tính mới
    public $rank = 'Chưa có xếp hạng';
    public $gradedAssignments = 0;
    public $assignmentsChecked = 0;

    public function mount($student)
    {
        $this->student = Student::with(['user', 'classrooms'])->findOrFail($student);

        $this->classNames = $this->student->classrooms->pluck('name')->toArray();

        $userId = $this->student->user_id;
        $studentTableId = $this->student->id;

        // ==================== ĐIỂM TRUNG BÌNH ====================
        $homeworkAvg = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'homework')
            ->avg('score') ?? 0;

        $minitestAvg = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'minitest')
            ->avg('score') ?? 0;

        $monthlyExamAvg = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score') ?? 0;

        $this->avgScore = round(($homeworkAvg * 0.1) + ($minitestAvg * 0.3) + ($monthlyExamAvg * 0.6), 1);

        // ==================== TỶ LỆ NỘP BÀI ====================
        $classIds = $this->student->classrooms->pluck('id');

        $this->assignmentsChecked = DB::table('grades')
            ->where('grade_type', 'homework')
            ->whereNotNull('assignment_id')
            ->when($classIds->isNotEmpty(), fn($q) => $q->whereIn('class_id', $classIds))
            ->distinct()
            ->count('assignment_id');

        $this->gradedAssignments = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'homework')
            ->whereNotNull('assignment_id')
            ->distinct()
            ->count('assignment_id');

        $this->submitRate = $this->assignmentsChecked > 0 
            ? round(($this->gradedAssignments / $this->assignmentsChecked) * 100) 
            : 0;

        // ==================== XẾP HẠNG (đồng bộ logic với Index) ====================
        $this->calculateRank($userId);

        // ==================== ĐIỂM DANH ====================
        $this->attendanceCount = DB::table('attendances')
            ->where('student_id', $studentTableId)
            ->when($classIds->isNotEmpty(), fn($q) => $q->whereIn('class_id', $classIds))
            ->where('present', 1)
            ->count();

        $this->totalAttendance = DB::table('attendances')
            ->where('student_id', $studentTableId)
            ->when($classIds->isNotEmpty(), fn($q) => $q->whereIn('class_id', $classIds))
            ->count();

        $this->attendanceRate = $this->totalAttendance > 0 
            ? round(($this->attendanceCount / $this->totalAttendance) * 100) 
            : 0;

        // ==================== BÀI CHƯA CHẤM ====================
        $assignments = Assignment::when($classIds->isNotEmpty(), fn($q) => $q->whereIn('class_id', $classIds))->get();

        $gradedIds = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'homework')
            ->whereNotNull('assignment_id')
            ->pluck('assignment_id');

        $this->uncheckedAssignments = $assignments->filter(fn($a) => !$gradedIds->contains($a->id));
    }

    private function calculateRank($userId)
    {
        // Lấy tất cả học viên để tính rank (giống Index)
        $allStudents = DB::table('users')
            ->where('users.role', 'student')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->leftJoin('class_user', function ($join) {
                $join->on('users.id', '=', 'class_user.user_id')
                     ->where('class_user.role', 'student');
            })
            ->leftJoin('classrooms', 'classrooms.id', '=', 'class_user.class_id')
            ->select(
                'users.id as user_id',
                'users.name',
                'students.id as student_table_id',
                'classrooms.name as class_name'
            )
            ->get();

        $reportData = [];

        foreach ($allStudents as $s) {
            $avg = $this->calculateAverage($s->user_id);

            preg_match('/\d+/', $s->class_name ?? '', $m);
            $gradeLevel = $m[0] ?? 0;

            $reportData[] = [
                'user_id' => $s->user_id,
                'average_score' => $avg,
                'grade_level' => $gradeLevel,
                'student_name' => $s->name,
            ];
        }

        $ranked = collect($reportData)
            ->filter(fn($s) => $s['average_score'] > 0)
            ->sort(function ($a, $b) {
                if ($a['grade_level'] != $b['grade_level']) {
                    return $a['grade_level'] <=> $b['grade_level'];
                }
                if ($a['average_score'] != $b['average_score']) {
                    return $b['average_score'] <=> $a['average_score'];
                }
                return strcmp($a['student_name'], $b['student_name']);
            })
            ->values();

        $currentGrade = null;
        $currentRank = 0;
        $displayRank = 0;
        $lastScore = null;

        foreach ($ranked as $s) {
            if ($currentGrade != $s['grade_level']) {
                $currentGrade = $s['grade_level'];
                $currentRank = 0;
                $displayRank = 0;
                $lastScore = null;
            }

            $currentRank++;
            if ($lastScore !== $s['average_score']) {
                $displayRank = $currentRank;
                $lastScore = $s['average_score'];
            }

            if ($s['user_id'] == $userId) {
                $this->rank = '#' . $displayRank;
                return;
            }
        }

        $this->rank = 'Chưa có xếp hạng';
    }

    private function calculateAverage($userId)
    {
        $h = DB::table('grades')->where('student_id', $userId)->where('grade_type', 'homework')->avg('score') ?? 0;
        $m = DB::table('grades')->where('student_id', $userId)->where('grade_type', 'minitest')->avg('score') ?? 0;
        $e = DB::table('grades')->where('student_id', $userId)->where('grade_type', 'monthly_exam')->avg('score') ?? 0;

        return round(($h * 0.1) + ($m * 0.3) + ($e * 0.6), 1);
    }

    public function render()
    {
        return view('admin.reports.student-report', [
            'student' => $this->student,
            'classNames' => $this->classNames,
            'avgScore' => $this->avgScore,
            'submitRate' => $this->submitRate,
            'attendanceCount' => $this->attendanceCount,
            'totalAttendance' => $this->totalAttendance,
            'attendanceRate' => $this->attendanceRate,
            'uncheckedAssignments' => $this->uncheckedAssignments,
            'rank' => $this->rank,
            'gradedAssignments' => $this->gradedAssignments,
            'assignmentsChecked' => $this->assignmentsChecked,
        ]);
    }
}