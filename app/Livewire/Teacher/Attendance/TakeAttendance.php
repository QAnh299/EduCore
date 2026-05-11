<?php

namespace App\Livewire\Teacher\Attendance;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TakeAttendance extends Component
{
    public Classroom $classroom;

    public $attendanceData = [];

    public $showReasonModal = false;

    public $selectedStudentId;

    public $absenceReason = '';

    public $canTakeAttendance = true;

    public $attendanceMessage = '';

    protected function rules()
    {
        return [
            'absenceReason' => 'nullable|string|max:255',
        ];
    }

    public function mount($classroom)
    {
        $teacher = Auth::user();

        $hasPermission = $classroom->users()
            ->where('user_id', $teacher->id)
            ->where('class_user.role', 'teacher')
            ->exists();

        if (!$hasPermission) {
            abort(403);
        }

        $this->classroom = $classroom;

        $this->checkAttendancePermission();

        $this->loadAttendanceData();
    }

    /**
     * Kiểm tra quyền điểm danh theo:
     * - Đúng ngày học
     * - Đúng giờ học
     */

public function checkAttendancePermission()
{
    $schedule = $this->classroom->schedule;

    /**
     * Không có lịch học
     */
    if (!$schedule) {

        $this->canTakeAttendance = true;

        return;
    }

    /**
     * Convert JSON -> array
     */
    if (is_string($schedule)) {

        $schedule = json_decode($schedule, true);
    }

    /**
     * Sai format
     */
    if (!is_array($schedule)) {

        $this->canTakeAttendance = false;

        $this->attendanceMessage =
            'Lịch học không hợp lệ';

        return;
    }

    /**
     * Ví dụ:
     * "days": ["Tuesday","Friday"]
     */
    $days = $schedule['days'] ?? [];

    /**
     * Ví dụ:
     * "18:00 - 20:30"
     */
    $time = trim($schedule['time'] ?? '');

    if (
        empty($days)
        ||
        empty($time)
    ) {

        $this->canTakeAttendance = false;

        $this->attendanceMessage =
            'Lịch học chưa đầy đủ';

        return;
    }

    /**
     * Thứ hiện tại
     */
    $today = now()->format('l');

    /**
     * Kiểm tra đúng ngày học
     */
    if (!in_array($today, $days)) {

        $this->canTakeAttendance = false;

        $this->attendanceMessage =
            'Hôm nay không phải lịch học của lớp';

        return;
    }

    /**
     * Tách giờ học
     * Hỗ trợ:
     * 18:00 - 20:30
     * 18:00-20:30
     */
    $timeParts = preg_split('/\s*-\s*/', $time);

    if (count($timeParts) !== 2) {

        $this->canTakeAttendance = false;

        $this->attendanceMessage =
            'Khung giờ học không hợp lệ';

        return;
    }

    $startTime = trim($timeParts[0]);

    $endTime = trim($timeParts[1]);

    try {

        $now = now();

        $startDateTime = now()->copy()
            ->setTimeFromTimeString($startTime);

        $endDateTime = now()->copy()
            ->setTimeFromTimeString($endTime);

        /**
         * Nếu ca học qua đêm
         * VD: 22:00 - 01:00
         */
        if ($endDateTime->lt($startDateTime)) {

            $endDateTime->addDay();
        }

    } catch (\Exception $e) {

        $this->canTakeAttendance = false;

        $this->attendanceMessage =
            'Khung giờ học không hợp lệ';

        return;
    }

    /**
     * Cho phép điểm danh trong khoảng giờ học
     */
    if (
        $now->between(
            $startDateTime,
            $endDateTime
        )
    ) {

        $this->canTakeAttendance = true;

        $this->attendanceMessage = '';

        return;
    }

    /**
     * Ngoài giờ học
     */
    $this->canTakeAttendance = false;

    $this->attendanceMessage =
        'Chỉ có thể điểm danh từ '
        . $startDateTime->format('H:i')
        . ' đến '
        . $endDateTime->format('H:i');
}

    public function loadAttendanceData()
    {
        $students = $this->classroom
            ->students()
            ->orderBy('name')
            ->get();

        $existingAttendance = Attendance::where(
            'class_id',
            $this->classroom->id
        )
            ->whereDate(
                'date',
                now()->format('Y-m-d')
            )
            ->get()
            ->keyBy('student_id');

        $this->attendanceData = [];

        foreach ($students as $student) {

            $studentRecord = Student::where(
                'user_id',
                $student->id
            )->first();

            if (!$studentRecord) {
                continue;
            }

            $existing = $existingAttendance->get(
                $studentRecord->id
            );

            $this->attendanceData[$studentRecord->id] = [

                'student' => $student,

                'student_record' => $studentRecord,

                'present' => $existing
                    ? (bool) $existing->present
                    : true,

                'reason' => $existing
                    ? $existing->reason
                    : '',
            ];
        }
    }

    public function toggleAttendance($studentId)
    {
        $this->checkAttendancePermission();

        if (!$this->canTakeAttendance) {
            return;
        }

        if (isset($this->attendanceData[$studentId])) {

            $this->attendanceData[$studentId]['present']
                =
                !$this->attendanceData[$studentId]['present'];

            /**
             * Nếu có mặt -> xóa lý do
             */
            if (
                $this->attendanceData[$studentId]['present']
            ) {

                $this->attendanceData[$studentId]['reason']
                    = '';
            }
        }
    }

    public function openReasonModal($studentId)
    {
        $this->checkAttendancePermission();

        if (!$this->canTakeAttendance) {
            return;
        }

        if (
            isset($this->attendanceData[$studentId])
            &&
            !$this->attendanceData[$studentId]['present']
        ) {

            $this->selectedStudentId = $studentId;

            $this->absenceReason =
                $this->attendanceData[$studentId]['reason'];

            $this->showReasonModal = true;
        }
    }

    public function saveReason()
    {
        $this->validate();

        if (
            $this->selectedStudentId
            &&
            isset(
                $this->attendanceData[
                    $this->selectedStudentId
                ]
            )
        ) {

            $this->attendanceData[
                $this->selectedStudentId
            ]['reason']
                =
                $this->absenceReason;
        }

        $this->showReasonModal = false;

        $this->selectedStudentId = null;

        $this->absenceReason = '';
    }

    public function saveAttendance()
    {
        $this->checkAttendancePermission();

        if (!$this->canTakeAttendance) {

            session()->flash(
                'error',
                $this->attendanceMessage
            );

            return;
        }

        foreach ($this->attendanceData as $studentId => $data) {

            Attendance::updateOrCreate(
                [
                    'class_id' => $this->classroom->id,

                    'student_id' => $studentId,

                    'date' => now()->format('Y-m-d'),
                ],
                [
                    'present' => $data['present'],

                    'reason' => $data['present']
                        ? null
                        : $data['reason'],
                ]
            );
        }

        session()->flash(
            'message',
            'Điểm danh thành công'
        );
    }

    public function getAttendanceStats()
    {
        $totalStudents = count($this->attendanceData);

        $presentCount = collect(
            $this->attendanceData
        )
            ->where('present', true)
            ->count();

        $absentCount =
            $totalStudents - $presentCount;

        return [

            'total' => $totalStudents,

            'present' => $presentCount,

            'absent' => $absentCount,

            'presentPercentage' => $totalStudents > 0
                ? round(
                    ($presentCount / $totalStudents) * 100
                )
                : 0,
        ];
    }

    public function render()
    {
        $this->checkAttendancePermission();
        
        return view(
            'teacher.attendance.take-attendance',
            [
                'stats' => $this->getAttendanceStats(),
            ]
        );
    }
}