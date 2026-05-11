<?php

namespace App\Livewire\Teacher\Reports;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $selectedClass = '';

    public $classrooms = [];

    public $reportData = [];

    public function mount()
    {
        $teacherId = Auth::id();

        /**
         * Lấy lớp giáo viên phụ trách
         * từ bảng class_user
         */
        $classroomIds = DB::table('class_user')
            ->where('user_id', $teacherId)
            ->pluck('class_id');

        $this->classrooms = Classroom::whereIn(
            'id',
            $classroomIds
        )
            ->orderBy('name')
            ->get();
    }

    public function resetFilters()
    {
        $this->selectedClass = '';
    }

    /**
     * Tính điểm trung bình
     */
    private function calculateAverage($studentId)
    {
        $homework = Grade::where('student_id', $studentId)
            ->where('grade_type', 'homework')
            ->avg('score');

        $minitest = Grade::where('student_id', $studentId)
            ->where('grade_type', 'minitest')
            ->avg('score');

        $exam = Grade::where('student_id', $studentId)
            ->where('grade_type', 'monthly_exam')
            ->avg('score');

        $homework = $homework ?? 0;
        $minitest = $minitest ?? 0;
        $exam = $exam ?? 0;

        return round(
            ($homework * 0.1) +
            ($minitest * 0.3) +
            ($exam * 0.6),
            1
        );
    }

    public function render()
    {
        $teacherId = Auth::id();

        /**
         * Lấy danh sách lớp giáo viên dạy
         */
        $classroomIds = DB::table('class_user')
            ->where('user_id', $teacherId)
            ->pluck('class_id');

        /**
         * Query học sinh
         */
        $students = User::query()

            ->where('role', 'student')

            ->with('classrooms')

            ->whereHas('classrooms', function ($q) use ($classroomIds) {

                $q->whereIn(
                    'classrooms.id',
                    $classroomIds
                );
            })

            ->when($this->selectedClass, function ($q) {

                $q->whereHas('classrooms', function ($query) {

                    $query->where(
                        'classrooms.id',
                        $this->selectedClass
                    );
                });
            })

            ->get();

        /**
         * ============================
         * GẮN DỮ LIỆU
         * ============================
         */
        $students->transform(function ($student) {

            /**
             * Điểm trung bình
             */
            $student->average_score =
                $this->calculateAverage(
                    $student->id
                );

            /**
             * Khối
             */
            if ($student->classrooms->isNotEmpty()) {

                $classroomName =
                    $student->classrooms
                        ->first()
                        ->name;

                preg_match(
                    '/\d+/',
                    $classroomName,
                    $matches
                );

                $student->grade_level =
                    $matches[0] ?? 0;

            } else {

                $student->grade_level = 0;
            }

            /**
             * Danh sách lớp
             */
            $studentClassIds =
                $student->classrooms
                    ->pluck('id');

            /**
             * ============================
             * TỶ LỆ NỘP BÀI
             * ============================
             */

            /**
             * Số bài đã được chấm
             * = bài có ít nhất 1 học sinh được nhập điểm
             */
            $assignmentsChecked = Grade::where(
                'grade_type',
                'homework'
            )
                ->whereNotNull('assignment_id')
                ->whereIn(
                    'class_id',
                    $studentClassIds
                )
                ->distinct()
                ->count('assignment_id');

            /**
             * Số bài học sinh được nhập điểm
             */
            $gradedAssignments = Grade::where(
                'student_id',
                $student->id
            )
                ->where('grade_type', 'homework')
                ->whereNotNull('assignment_id')
                ->distinct()
                ->count('assignment_id');

            $student->submit_rate =
                $assignmentsChecked > 0
                    ? round(
                        (
                            $gradedAssignments
                            /
                            $assignmentsChecked
                        ) * 100
                    )
                    : 0;

            $student->graded_assignments =
                $gradedAssignments;

            $student->assignments_checked =
                $assignmentsChecked;

           /**
 * ============================
 * ĐIỂM DANH
 * ============================
 */

/**
 * Map user -> student record
 */
$studentRecord = Student::where(
    'user_id',
    $student->id
)->first();

if ($studentRecord) {

    $student->present_count =
        Attendance::where(
            'student_id',
            $studentRecord->id
        )
            ->where('present', true)
            ->count();

    $student->total_attendance =
        Attendance::where(
            'student_id',
            $studentRecord->id
        )
            ->count();

} else {

    $student->present_count = 0;

    $student->total_attendance = 0;
}
            return $student;
        });

        /**
         * ============================
         * SORT GIỐNG QUẢN LÝ ĐIỂM
         * ============================
         */

        $rankedStudents = $students

            ->filter(function ($student) {

                return $student->average_score > 0;
            })

            ->sort(function ($a, $b) {

                /**
                 * Sort theo khối
                 */
                if (
                    $a->grade_level
                    !=
                    $b->grade_level
                ) {

                    return $a->grade_level
                        <=>
                        $b->grade_level;
                }

                /**
                 * Sort theo điểm
                 */
                if (
                    $a->average_score
                    !=
                    $b->average_score
                ) {

                    return $b->average_score
                        <=>
                        $a->average_score;
                }

                /**
                 * Sort theo tên
                 */
                return strcmp(
                    $a->name,
                    $b->name
                );
            });

        /**
         * Học sinh chưa có điểm
         */
        $unrankedStudents = $students

            ->filter(function ($student) {

                return $student->average_score <= 0;
            });

        /**
         * Gộp lại
         */
        $students = $rankedStudents
            ->concat($unrankedStudents)
            ->values();

        return view(
            'teacher.reports.index',
            [
                'students' => $students,
                'classrooms' => $this->classrooms,
            ]
        );
    }
}