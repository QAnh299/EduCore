<div>

<x-layouts.dash-admin active="reports">

    @include('components.language')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-bar-chart mr-2"></i>
                Báo cáo & Thống kê học tập
            </h4>

            <div class="text-muted fs-5">
                Tổng hợp tiến độ, điểm, tỷ lệ nộp bài,
                số buổi tham gia của toàn bộ học viên
            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <!-- LỚP -->
                <div class="col-md-4">

                    <label class="form-label fw-bold">
                        Lọc theo lớp
                    </label>

                    <select
                        class="form-control"
                        wire:model.live="selectedClass"
                    >

                        <option value="">
                            Tất cả lớp
                        </option>

                        @foreach ($classrooms as $classroom)

                            <option value="{{ $classroom->id }}">
                                {{ $classroom->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- HỌC VIÊN -->
                <div class="col-md-4">

                    <label class="form-label fw-bold">
                        Tìm kiếm học viên
                    </label>

                    <select
                        class="form-control"
                        wire:model.live="selectedStudent"
                    >

                        <option value="">
                            Tất cả học viên
                        </option>

                        @foreach ($students as $student)

                            <option value="{{ $student->id }}">
                                {{ $student->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- RESET -->
                <div class="col-md-4">

                    <label class="form-label">
                        &nbsp;
                    </label>

                    <button
                        class="btn btn-outline-secondary w-100"
                        wire:click="resetFilters"
                    >

                        <i class="bi bi-arrow-clockwise mr-1"></i>

                        Đặt lại

                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                >

                    <thead class="table-light">

                        <tr>

                            <th>Học viên</th>

                            <th>Lớp</th>

                            <th>Điểm trung bình</th>

                            <th>Xếp hạng</th>

                            <th>Tỷ lệ nộp bài</th>

                            <th>Số buổi tham gia</th>

                            <th width="120">
                                Chi tiết
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($reportData as $student)

                            <tr>

                                <!-- TÊN -->
                                <td class="fw-semibold">

                                    {{ $student['student_name'] }}

                                </td>

                                <!-- LỚP -->
                                <td>

                                    @if($student['class_name'])

                                        <span class="badge bg-primary">

                                            {{ $student['class_name'] }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Chưa có lớp
                                        </span>

                                    @endif

                                </td>

                                <!-- ĐIỂM TB -->
                                <td>

                                    @if($student['average_score'] > 0)

                                        <span
                                            class="fw-bold text-primary"
                                        >

                                            {{ number_format($student['average_score'], 1) }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Chưa có điểm
                                        </span>

                                    @endif

                                </td>

                                <!-- XẾP HẠNG -->
                                <td>

                                    @if(
                                        $student['rank']
                                        !=
                                        'Chưa có xếp hạng'
                                    )

                                        <span
                                            class="badge bg-warning text-dark"
                                        >

                                            {{ $student['rank'] }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Chưa có xếp hạng
                                        </span>

                                    @endif

                                </td>

                                <!-- TỶ LỆ NỘP BÀI -->
                                <td>

                                    <div class="fw-bold">

                                        {{ $student['submit_rate'] }}%

                                    </div>

                                    <small class="text-muted">

                                        {{ $student['graded_assignments'] }}
                                        /
                                        {{ $student['assignments_checked'] }}
                                        bài

                                    </small>

                                </td>

                                <!-- ĐIỂM DANH -->
                                <td>

                                    <div
                                        class="fw-bold text-info"
                                    >

                                        {{ $student['present_count'] }}
                                        /
                                        {{ $student['total_attendance'] }}
                                        buổi

                                    </div>

                                    <small class="text-muted">

                                        {{ $student['attendance_rate'] }}%

                                    </small>

                                </td>

                                <!-- CHI TIẾT -->
                                <td>

                                    <a
                                        href="{{ route('reports.student', $student['student_id']) }}"
                                        class="btn btn-outline-primary btn-sm"
                                    >

                                        Xem

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-4 text-muted"
                                >

                                    Không có dữ liệu

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-layouts.dash-admin>

</div>