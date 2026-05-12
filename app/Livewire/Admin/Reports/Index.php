<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;

class Index extends Component
{
    public $selectedClass = '';

    public $selectedStudent = '';

    public $classrooms = [];

    public $students = [];

    public function mount()
    {
        $this->classrooms = Classroom::orderBy('name')->get();

        $this->students = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select(
                'students.id',
                'users.name'
            )
            ->orderBy('users.name')
            ->get();
    }

    public function resetFilters()
    {
        $this->selectedClass = '';
        $this->selectedStudent = '';
    }

    /**
     * grades.student_id = users.id
     */
    private function calculateAverage($userId)
    {
        $homework = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'homework')
            ->avg('score');

        $minitest = DB::table('grades')
            ->where('student_id', $userId)
            ->where('grade_type', 'minitest')
            ->avg('score');

        $exam = DB::table('grades')
            ->where('student_id', $userId)
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
        /**
         * =====================================
         * LẤY TOÀN BỘ HỌC VIÊN TRƯỚC
         * KHÔNG FILTER ĐỂ TÍNH RANK CHUẨN
         * =====================================
         */

        $allStudents = DB::table('users')

            ->where('users.role', 'student')

            ->join(
                'students',
                'students.user_id',
                '=',
                'users.id'
            )

            ->leftJoin('class_user', function ($join) {

                $join->on(
                    'users.id',
                    '=',
                    'class_user.user_id'
                )
                ->where(
                    'class_user.role',
                    'student'
                );
            })

            ->leftJoin(
                'classrooms',
                'classrooms.id',
                '=',
                'class_user.class_id'
            )

            ->select(
                'users.id as user_id',
                'users.name as student_name',
                'students.id as student_table_id',
                'classrooms.id as class_id',
                'classrooms.name as class_name'
            )

            ->get();

        $reportData = [];

        foreach ($allStudents as $student) {

            /**
             * =========================
             * ĐIỂM TRUNG BÌNH
             * =========================
             */

            $averageScore =
                $this->calculateAverage(
                    $student->user_id
                );

            /**
             * =========================
             * KHỐI
             * =========================
             */

            preg_match(
                '/\d+/',
                $student->class_name ?? '',
                $matches
            );

            $gradeLevel =
                $matches[0] ?? 0;

            /**
             * =========================
             * TỶ LỆ NỘP BÀI
             * LOGIC GIỐNG GIÁO VIÊN
             * =========================
             */

            $assignmentsChecked = DB::table('grades')

                ->where('grade_type', 'homework')

                ->whereNotNull('assignment_id')

                ->when(
                    $student->class_id,
                    function ($q) use ($student) {

                        $q->where(
                            'class_id',
                            $student->class_id
                        );
                    }
                )

                ->distinct()

                ->count('assignment_id');

            $gradedAssignments = DB::table('grades')

                ->where(
                    'student_id',
                    $student->user_id
                )

                ->where('grade_type', 'homework')

                ->whereNotNull('assignment_id')

                ->distinct()

                ->count('assignment_id');

            $submitRate =
                $assignmentsChecked > 0
                    ? round(
                        (
                            $gradedAssignments
                            /
                            $assignmentsChecked
                        ) * 100
                    )
                    : 0;

            /**
             * =========================
             * ĐIỂM DANH
             * attendances.student_id = students.id
             * =========================
             */

            $presentCount = DB::table('attendances')

                ->where(
                    'student_id',
                    $student->student_table_id
                )

                ->where('present', 1)

                ->count();

            $totalAttendance = DB::table('attendances')

                ->where(
                    'student_id',
                    $student->student_table_id
                )

                ->count();

            $attendanceRate =
                $totalAttendance > 0
                    ? round(
                        (
                            $presentCount
                            /
                            $totalAttendance
                        ) * 100
                    )
                    : 0;

            $reportData[] = [

                'student_id' =>
                    $student->student_table_id,

                'student_name' =>
                    $student->student_name,

                'class_name' =>
                    $student->class_name,

                'class_id' =>
                    $student->class_id,

                'grade_level' =>
                    $gradeLevel,

                'average_score' =>
                    $averageScore,

                'submit_rate' =>
                    $submitRate,

                'graded_assignments' =>
                    $gradedAssignments,

                'assignments_checked' =>
                    $assignmentsChecked,

                'present_count' =>
                    $presentCount,

                'total_attendance' =>
                    $totalAttendance,

                'attendance_rate' =>
                    $attendanceRate,
            ];
        }

        /**
         * =====================================
         * SORT GIỐNG GIÁO VIÊN
         * =====================================
         */

        $rankedStudents = collect($reportData)

            ->filter(function ($student) {

                return $student['average_score'] > 0;
            })

            ->sort(function ($a, $b) {

                if (
                    $a['grade_level']
                    !=
                    $b['grade_level']
                ) {

                    return
                        $a['grade_level']
                        <=>
                        $b['grade_level'];
                }

                if (
                    $a['average_score']
                    !=
                    $b['average_score']
                ) {

                    return
                        $b['average_score']
                        <=>
                        $a['average_score'];
                }

                return strcmp(
                    $a['student_name'],
                    $b['student_name']
                );
            })

            ->values();

        /**
         * =====================================
         * GÁN RANK TOÀN CỤC
         * =====================================
         */

        $currentGrade = null;

        $currentRank = 0;

        $displayRank = 0;

        $lastScore = null;

        $rankedStudents =
            $rankedStudents->map(function ($student)
            use (
                &$currentGrade,
                &$currentRank,
                &$displayRank,
                &$lastScore
            ) {

                if (
                    $currentGrade
                    !=
                    $student['grade_level']
                ) {

                    $currentGrade =
                        $student['grade_level'];

                    $currentRank = 0;

                    $displayRank = 0;

                    $lastScore = null;
                }

                $currentRank++;

                if (
                    $lastScore
                    !==
                    $student['average_score']
                ) {

                    $displayRank =
                        $currentRank;

                    $lastScore =
                        $student['average_score'];
                }

                $student['rank'] =
                    '#' . $displayRank;

                return $student;
            });

        /**
         * =====================================
         * HỌC VIÊN CHƯA CÓ ĐIỂM
         * =====================================
         */

        $unrankedStudents = collect($reportData)

            ->filter(function ($student) {

                return
                    $student['average_score'] <= 0;
            })

            ->map(function ($student) {

                $student['rank'] =
                    'Chưa có xếp hạng';

                return $student;
            });

        /**
         * =====================================
         * GỘP
         * =====================================
         */

        $reportData = $rankedStudents
            ->concat($unrankedStudents)
            ->values();

        /**
         * =====================================
         * FILTER SAU KHI ĐÃ CÓ RANK
         * =====================================
         */

        if ($this->selectedClass) {

            $reportData = $reportData->filter(function ($student) {

                return
                    $student['class_id']
                    ==
                    $this->selectedClass;
            });
        }

        if ($this->selectedStudent) {

            $reportData = $reportData->filter(function ($student) {

                return
                    $student['student_id']
                    ==
                    $this->selectedStudent;
            });
        }

        return view(
            'admin.reports.index',
            [
                'classrooms' => $this->classrooms,
                'students' => $this->students,
                'reportData' => $reportData->values(),
            ]
        );
    }
}