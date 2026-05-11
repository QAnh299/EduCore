<x-layouts.dash-teacher active="attendances">

    @include('components.language')

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="mb-4">

            <a
                href="{{ route('teacher.my-class.index') }}"
                class="text-decoration-none text-secondary d-inline-block mb-3"
            >
                <i class="bi bi-arrow-left mr-2"></i>
                Quay lại lớp học
            </a>

            <h4 class="mb-0 text-primary fs-4">

                <i class="bi bi-calendar-check mr-2"></i>

                Điểm danh - {{ $classroom->name }}

            </h4>

        </div>

        <!-- THỐNG KÊ -->
        <div class="row mb-4">

            <div class="col-md-3">

                <div class="card bg-primary text-white">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="card-title mb-0">
                                    Tổng học sinh
                                </h6>

                                <h3 class="mb-0">
                                    {{ $stats['total'] }}
                                </h3>

                            </div>

                            <div class="align-self-center">

                                <i class="bi bi-people fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-success text-white">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="card-title mb-0">
                                    Có mặt
                                </h6>

                                <h3 class="mb-0">
                                    {{ $stats['present'] }}
                                </h3>

                            </div>

                            <div class="align-self-center">

                                <i class="bi bi-check-circle fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-warning text-white">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="card-title mb-0">
                                    Vắng
                                </h6>

                                <h3 class="mb-0">
                                    {{ $stats['absent'] }}
                                </h3>

                            </div>

                            <div class="align-self-center">

                                <i class="bi bi-x-circle fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-info text-white">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="card-title mb-0">
                                    Tỷ lệ tham gia
                                </h6>

                                <h3 class="mb-0">
                                    {{ $stats['presentPercentage'] }}%
                                </h3>

                            </div>

                            <div class="align-self-center">

                                <i class="bi bi-percent fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="card shadow-sm">

            <div class="card-header bg-light">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h5 class="mb-0 text-primary">

                            <i class="bi bi-calendar-event mr-2"></i>

                            Điểm danh ngày
                            {{ now()->format('d/m/Y') }}

                            <small class="text-muted ml-2">
                                ({{ now()->format('H:i') }})
                            </small>

                        </h5>

                    </div>

                    <div class="col-md-4 text-end">

                        <button
                            wire:click="saveAttendance"
                            class="btn btn-primary"
                            {{ !$canTakeAttendance ? 'disabled' : '' }}
                        >

                            <i class="bi bi-save mr-2"></i>

                            Lưu điểm danh

                        </button>

                    </div>

                </div>

            </div>

            <div class="card-body">

                @if (session()->has('message'))

                    <div class="alert alert-success">

                        {{ session('message') }}

                    </div>

                @endif

                @if (session()->has('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                @endif

                @if (!$canTakeAttendance)

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-triangle mr-2"></i>

                        {{ $attendanceMessage }}

                    </div>

                @endif

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Học sinh</th>

                                <th>Trạng thái</th>

                                <th>Lý do nghỉ</th>

                                <th>Thao tác</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($attendanceData as $index => $data)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $data['student']->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $data['student']->email }}
                                        </small>

                                    </td>

                                    <td>

                                        <div class="form-check form-switch">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                wire:click="toggleAttendance({{ $data['student_record']->id }})"
                                                {{ $data['present'] ? 'checked' : '' }}
                                                {{ !$canTakeAttendance ? 'disabled' : '' }}
                                            >

                                            @if ($data['present'])

                                                <span class="badge bg-success">

                                                    <i class="bi bi-check-circle mr-1"></i>

                                                    Có mặt

                                                </span>

                                            @else

                                                <span class="badge bg-danger">

                                                    <i class="bi bi-x-circle mr-1"></i>

                                                    Vắng

                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                    <td>

                                        @if (!$data['present'])

                                            {{ $data['reason'] ?: 'Chưa có lý do' }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td>

                                        @if (!$data['present'])

                                            <button
                                                class="btn btn-sm btn-outline-primary"
                                                wire:click="openReasonModal({{ $data['student_record']->id }})"
                                                {{ !$canTakeAttendance ? 'disabled' : '' }}
                                            >

                                                Lý do

                                            </button>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    @if ($showReasonModal)

        <div class="modal fade show d-block">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Nhập lý do nghỉ

                        </h5>

                    </div>

                    <div class="modal-body">

                        <textarea
                            wire:model="absenceReason"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                    <div class="modal-footer">

                        <button
                            class="btn btn-secondary"
                            wire:click="$set('showReasonModal', false)"
                        >
                            Hủy
                        </button>

                        <button
                            class="btn btn-primary"
                            wire:click="saveReason"
                        >
                            Lưu
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal-backdrop fade show"></div>

    @endif

</x-layouts.dash-teacher>