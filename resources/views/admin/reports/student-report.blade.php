<x-layouts.dash-admin active="reports">

    @include('components.language')

    <!-- BACK -->
    <div class="mb-4">

        <a
            href="{{ route('reports.index') }}"
            class="btn btn-outline-secondary px-4"
        >
            <i class="bi bi-arrow-left me-2"></i>

            {{ __('general.back_to_summary_report') }}
        </a>

    </div>

    <!-- HEADER -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <!-- TITLE -->
            <div class="mb-4">

                <h3 class="fw-bold text-primary mb-2">

                    <i class="bi bi-bar-chart-line-fill me-2"></i>

                    {{ __('views.detailed_student_report') }}

                </h3>

                <div class="text-muted">

                    Theo dõi kết quả học tập và quá trình tham gia học tập của học viên.

                </div>

            </div>

            <!-- STUDENT INFO -->
<div class="d-flex align-items-center">

    <!-- AVATAR -->
    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center flex-shrink-0"
         style="width: 35px; height: 35px;">
        <i class="bi bi-person-fill text-white" style="font-size: 20px;"></i>
    </div>

    <!-- INFO -->
    <div class="ms-4" style="margin-left: 10px;">

        <div class="d-flex align-items-center gap-3">
            <h4 class="fw-bold text-primary mb-0">
                {{$student->user->name }}
            </h4>
            <span class="badge bg-warning text-dark px-3 py-1">
                {{ $rank }}
            </span>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-2">
            @forelse ($classNames as $cname)
                <span class="badge bg-primary px-3 py-2" style="font-size: 14px;">
                    {{ $cname }}
                </span>
            @empty
                <span class="text-muted">Chưa có lớp</span>
            @endforelse
        </div>

    </div>
</div>

        </div>

    </div>

    <!-- STATS -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">

        <!-- AVG -->
        <div class="col">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body text-center py-4">

                    <div class="text-muted fw-semibold mb-3">
                        Điểm trung bình
                    </div>

                    <div
                        class="fw-bold text-primary"
                        style="font-size: 40px;"
                    >

                        {{ $avgScore }}

                    </div>

                </div>

            </div>

        </div>

        <!-- SUBMIT -->
<div class="col">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center py-4">
            <div class="text-muted fw-semibold mb-3">
                Tỷ lệ nộp bài
            </div>

            <div class="fw-bold text-success" style="font-size: 40px;">
                {{ $submitRate }}%
            </div>

            <div class="text-muted mt-2">
                <strong>{{ $gradedAssignments }} / {{ $assignmentsChecked }}</strong> bài
            </div>
        </div>
    </div>
</div>

        <!-- ATTENDANCE -->
        <div class="col">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body text-center py-4">

                    <div class="text-muted fw-semibold mb-3">
                        Số buổi tham gia
                    </div>

                    <div
                        class="fw-bold text-info"
                        style="font-size: 35px;"
                    >

                        {{ $attendanceCount }}
                        /
                        {{ $totalAttendance }}

                    </div>

                    <div class="text-muted mt-2">

                        {{ $attendanceRate }}%

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ASSIGNMENTS -->
    <div class="card border-0 shadow-sm">

        <div
            class="card-header bg-white border-0 py-3"
            style="
                font-size: 18px;
                font-weight: 700;
            "
        >

            <i class="bi bi-journal-x me-2"></i>

            BTVN chưa được chấm điểm

        </div>

        <div class="card-body p-0">

            <ul class="list-group list-group-flush">

                @forelse($uncheckedAssignments as $assignment)

                    <li
                        class="list-group-item d-flex justify-content-between align-items-center py-3 px-4"
                    >

                        <div>

                            {{ $assignment->title }}

                        </div>

                        <span
                            class="badge bg-warning text-dark px-3 py-2"
                        >

                            Chưa chấm điểm

                        </span>

                    </li>

                @empty

                    <li class="list-group-item py-4 text-center text-muted">

                        Không có bài tập nào chờ chấm điểm

                    </li>

                @endforelse

            </ul>

        </div>

    </div>

</x-layouts.dash-admin>