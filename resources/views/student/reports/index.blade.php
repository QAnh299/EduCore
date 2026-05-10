<x-layouts.dash-student active="reports">

    @include('components.language')

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="mb-0 text-primary fs-4">
                        <i class="bi bi-bar-chart-fill mr-2"></i>
                        Kết quả học tập
                    </h4>

                    <p class="text-muted mb-0">
                        Tổng quan điểm số và điểm danh của bạn trong quá trình học
                    </p>

                </div>

            </div>

        </div>

        <!-- THỐNG KÊ -->
        <div class="row mb-4">

            <!-- ĐIỂM TB -->
            <div class="col-6 col-md-3 mb-3">

                <div class="card text-center h-100">

                    <div class="card-body">

                        <div class="mb-2">

                            <i class="bi bi-journal-text"
                               style="font-size:2.5rem; color:#0dcaf0;"></i>

                        </div>

                        <div class="fw-bold">
                            Điểm trung bình
                        </div>

                        <div class="fs-3 text-primary fw-bold">

                            @if($average > 0)

                                {{ number_format($average, 1) }}

                            @else

                                0

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- XẾP HẠNG -->
            <div class="col-6 col-md-3 mb-3">

                <div class="card text-center h-100">

                    <div class="card-body">

                        <div class="mb-2">

                            <i class="bi bi-trophy-fill"
                               style="font-size:2.5rem; color:#28a745;"></i>

                        </div>

                        <div class="fw-bold">
                            Xếp hạng theo khối
                        </div>

                        <div class="fs-3 text-success fw-bold">

                            @if($rank)

                                {{ $rank }} / {{ $totalStudents }}

                            @else

                                Chưa có

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- CÓ MẶT -->
            <div class="col-6 col-md-3 mb-3">

                <div class="card text-center h-100">

                    <div class="card-body">

                        <div class="mb-2">

                            <i class="bi bi-person-check-fill"
                               style="font-size:2.5rem; color:#20c997;"></i>

                        </div>

                        <div class="fw-bold">
                            Số lần có mặt
                        </div>

                        <div class="fs-3 text-info fw-bold">

                            {{ $attendancePresent }}

                        </div>

                    </div>

                </div>

            </div>

            <!-- VẮNG -->
            <div class="col-6 col-md-3 mb-3">

                <div class="card text-center h-100">

                    <div class="card-body">

                        <div class="mb-2">

                            <i class="bi bi-person-x-fill"
                               style="font-size:2.5rem; color:#dc3545;"></i>

                        </div>

                        <div class="fw-bold">
                            Số lần vắng
                        </div>

                        <div class="fs-3 text-danger fw-bold">

                            {{ $attendanceAbsent }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- TABS -->
        <div class="card">

            <div class="card-header bg-white border-bottom-0">

                <ul class="nav nav-tabs card-header-tabs">

                    <!-- BTVN -->
                    <li class="nav-item">

                        <button
                            class="nav-link {{ $activeTab === 'assignments' ? 'active' : '' }}"
                            wire:click="setTab('assignments')"
                        >

                            <i class="bi bi-journal-check mr-1"></i>

                            Điểm bài tập

                        </button>

                    </li>

                    <!-- KIỂM TRA -->
                    <li class="nav-item">

                        <button
                            class="nav-link {{ $activeTab === 'quizzes' ? 'active' : '' }}"
                            wire:click="setTab('quizzes')"
                        >

                            <i class="bi bi-clipboard-check mr-1"></i>

                            Điểm kiểm tra

                        </button>

                    </li>

                    <!-- ĐIỂM DANH -->
                    <li class="nav-item">

                        <button
                            class="nav-link {{ $activeTab === 'attendance' ? 'active' : '' }}"
                            wire:click="setTab('attendance')"
                        >

                            <i class="bi bi-calendar-check mr-1"></i>

                            Thống kê điểm danh

                        </button>

                    </li>

                </ul>

            </div>

            <div class="card-body p-0">

                {{-- ========================= --}}
                {{-- TAB BTVN --}}
                {{-- ========================= --}}
                @if ($activeTab === 'assignments')

                    <div class="table-responsive">

                        <table class="table table-bordered mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Bài tập</th>
                                    <th>Lớp</th>
                                    <th>Điểm</th>
                                    <th>Nhận xét</th>
                                    <th>Ngày nộp</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($assignmentSubmissionsPaginated as $grade)

                                    <tr>

                                        <td>
                                            {{ $grade->assignment->title ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $grade->assignment->classroom->name ?? '-' }}
                                        </td>

                                        <td>

                                            <span class="badge bg-primary">

                                                {{ number_format($grade->score, 1) }}

                                            </span>

                                        </td>

                                        <td>
                                            {{ $grade->feedback ?? '-' }}
                                        </td>

                                        <td>

                                            {{ $grade->created_at
                                                ? $grade->created_at->format('d/m/Y H:i')
                                                : '-' }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center">

                                            Chưa có bài tập nào

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="p-3">

                        {{ $assignmentSubmissionsPaginated->links() }}

                    </div>

                {{-- ========================= --}}
                {{-- TAB KIỂM TRA --}}
                {{-- ========================= --}}
                @elseif ($activeTab === 'quizzes')

                    <div class="table-responsive">

                        <table class="table table-bordered mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Loại điểm</th>
                                    <th>Lớp</th>
                                    <th>Điểm</th>
                                    <th>Nhận xét</th>
                                    <th>Ngày chấm</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($quizResultsPaginated as $grade)

                                    <tr>

                                        <td>

                                            @if($grade->grade_type == 'minitest')

                                                <span class="badge bg-warning text-dark">
                                                    Mini Test
                                                </span>

                                            @elseif($grade->grade_type == 'monthly_exam')

                                                <span class="badge bg-success">
                                                    Kiểm tra cuối tháng
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            {{ $grade->classroom->name ?? '-' }}

                                        </td>

                                        <td>

                                            <span class="badge bg-success">

                                                {{ number_format($grade->score, 1) }}

                                            </span>

                                        </td>

                                        <td>

                                            {{ $grade->feedback ?? '-' }}

                                        </td>

                                        <td>

                                            {{ $grade->graded_at
                                                ? \Carbon\Carbon::parse($grade->graded_at)->format('d/m/Y')
                                                : '-' }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center">

                                            Chưa có bài kiểm tra nào

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="p-3">

                        {{ $quizResultsPaginated->links() }}

                    </div>

                {{-- ========================= --}}
                {{-- TAB ĐIỂM DANH --}}
                {{-- ========================= --}}
                @elseif ($activeTab === 'attendance')

                    <div class="table-responsive">

                        <table class="table table-bordered mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Ngày</th>
                                    <th>Lớp</th>
                                    <th>Trạng thái</th>
                                    <th>Lý do vắng (nếu có)</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($attendancesPaginated as $attendance)

                                    <tr>

                                        <td>

                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}

                                        </td>

                                        <td>

                                            {{ $attendance->classroom->name ?? '-' }}

                                        </td>

                                        <td>

                                            @if ($attendance->present)

                                                <span class="badge bg-success">
                                                    Có mặt
                                                </span>

                                            @else

                                                <span class="badge bg-danger">
                                                    Vắng
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            {{ $attendance->reason ?? '-' }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center">

                                            Chưa có dữ liệu điểm danh

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="p-3">

                        {{ $attendancesPaginated->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-layouts.dash-student>