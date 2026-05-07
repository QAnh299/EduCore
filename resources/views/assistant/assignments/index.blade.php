
<x-layouts.dash-assistant active="assignments">
    @include('components.language')

    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 text-primary fs-4">
                    <i class="bi bi-journal-text mr-2"></i>
                    <strong>Bài tập về nhà</strong>
                </h4>

                <p class="text-muted mb-0">
                    Quản lý và chấm điểm bài tập cho học viên
                </p>
            </div>

            <div>
                <a href="{{ route('assistant.assignments.create') }}"
                    class="btn btn-primary">
                    <i class="bi bi-plus-circle mr-2"></i>
                    Tạo bài tập
                </a>
            </div>
        </div>

        <!-- Flash -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        <!-- Filter -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">
                        <input type="text"
                            wire:model.live="search"
                            class="form-control"
                            placeholder="Tìm bài tập...">
                    </div>

                    <div class="col-md-3">
                        <select wire:model.live="classroomFilter"
                            class="form-control">

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

                    <div class="col-md-2">
                        <select wire:model.live="selectedMonth"
                            class="form-control">

                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}">
                                    Tháng {{ $month }}
                                </option>
                            @endfor

                        </select>
                    </div>

                    <div class="col-md-2">
                        <select wire:model.live="selectedYear"
                            class="form-control">

                            @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                <option value="{{ $year }}">
                                    {{ $year }}
                                </option>
                            @endfor

                        </select>
                    </div>

                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">

            <!-- Tổng bài tập -->
            <div class="col-md-4">
                <div class="card bg-primary text-white shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h6 class="mb-1">
                                    Tổng bài tập
                                </h6>

                                <h2 class="mb-0">
                                    {{ $overviewStats['total_assignments'] ?? 0 }}
                                </h2>
                            </div>

                            <i class="bi bi-journal-text fs-1"></i>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Chưa chấm -->
            <div class="col-md-4">
                <div class="card bg-warning text-white shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h6 class="mb-1">
                                    Bài tập chưa chấm
                                </h6>

                                <h2 class="mb-0">
                                    {{ $overviewStats['ungraded_assignments'] ?? 0 }}
                                </h2>
                            </div>

                            <i class="bi bi-clipboard-x fs-1"></i>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Tỷ lệ -->
            <div class="col-md-4">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h6 class="mb-1">
                                    Tỷ lệ hoàn thành
                                </h6>

                                <h2 class="mb-0">
                                    {{ $overviewStats['completion_rate'] ?? 0 }}%
                                </h2>
                            </div>

                            <i class="bi bi-check-circle fs-1"></i>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Assignment Table -->
        <div class="card shadow-sm">

            <div class="card-header bg-light">
                <h5 class="mb-0 text-primary">
                    <i class="bi bi-clock-history mr-2"></i>
                    Danh sách bài tập
                </h5>
            </div>

            <div class="card-body">

                @if ($recentAssignments->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Lớp học</th>
                                    <th>Hạn nộp</th>
                                    <th>Ngày giao</th>
                                    <th>Trạng thái</th>
                                    <th>Đã nộp</th>
                                    <th width="220">Hành động</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($recentAssignments as $assignment)

                                    @php

                                        $studentCount =
                                            \App\Models\Student::whereHas(
                                                'classrooms',
                                                function ($q) use ($assignment) {
                                                    $q->where(
                                                        'classrooms.id',
                                                        $assignment->class_id,
                                                    );
                                                },
                                            )->count();

                                        $gradedCount =
                                            \App\Models\Grade::where(
                                                'assignment_id',
                                                $assignment->id,
                                            )
                                                ->whereNotNull('score')
                                                ->count();

                                        $isCompleted = $gradedCount > 0;
                                        
                                    @endphp

                                    <tr>

                                        <!-- Title -->
                                        <td>
                                            <div class="fw-semibold">
                                                {{ $assignment->title }}
                                            </div>
                                        </td>

                                        <!-- Classroom -->
                                        <td>
                                            {{ $assignment->classroom->name ?? '-' }}
                                        </td>

                                        <!-- Deadline -->
                                        <td>
                                            @if ($assignment->deadline)
                                                {{ $assignment->deadline->format('d/m/Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <!-- Created -->
                                        <td>
                                            {{ $assignment->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <!-- Status -->
                                        <td>

                                            @if ($isCompleted)

                                                <span class="badge bg-success">
                                                    Đã nộp
                                                </span>

                                            @else

                                                <span class="badge bg-warning text-dark">
                                                    Chưa chấm
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Submission -->
                                        <td>

                                            @if ($isCompleted)

                                                <span class="fw-bold text-success">
                                                    {{ $gradedCount }}/{{ $studentCount }}
                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    -
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Actions -->
                                        <td>

                                            <!-- Chấm điểm -->
                                            <a href="{{ route('assistant.assignments.show', $assignment->id) }}"
                                                class="btn btn-sm btn-success"
                                                title="Chấm điểm">

                                                <i class="bi bi-clipboard-check"></i>

                                            </a>

                                            <!-- Xem -->
                                            <a href="{{ route('assistant.assignments.show', $assignment->id) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Xem">

                                                <i class="bi bi-eye"></i>

                                            </a>

                                            <!-- Sửa -->
                                            <a href="{{ route('assistant.assignments.edit', $assignment->id) }}"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Sửa">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            <!-- Xóa -->
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                data-toggle="modal"
                                                data-target="#deleteAssignmentModal{{ $assignment->id }}"
                                                title="Xóa">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade"
                                        id="deleteAssignmentModal{{ $assignment->id }}"
                                        wire:ignore.self
                                        tabindex="-1">

                                        <div class="modal-dialog modal-dialog-centered">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <h5 class="modal-title">
                                                        Xác nhận xóa
                                                    </h5>

                                                    <button type="button"
                                                        class="close"
                                                        data-dismiss="modal">

                                                        <span>&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    Bạn có chắc muốn xóa bài tập:

                                                    <strong>
                                                        {{ $assignment->title }}
                                                    </strong>

                                                    ?

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">

                                                        Hủy

                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-danger"
                                                        wire:click.prevent="deleteAssignment({{ $assignment->id }})">

                                                        Xóa

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="text-center py-5">

                        <i class="bi bi-journal-x fs-1 text-muted"></i>

                        <h5 class="text-muted mt-3">
                            Chưa có bài tập nào
                        </h5>

                    </div>

                @endif

            </div>

        </div>

    </div>

    <script>
        window.addEventListener('closeModal', (event) => {

            const detail = event.detail;

            const modalId = Array.isArray(detail)
                ? detail[0]
                : (detail.modalId || detail);

            if (!modalId) return;

            const selector = `#${modalId}`;

            if (window.$) {

                $(selector).modal('hide');

            }

        });
    </script>

</x-layouts.dash-assistant>
