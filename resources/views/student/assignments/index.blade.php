<x-layouts.dash-student active="assignments">
    @include('components.language')

    <div class="container-fluid">

        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 text-primary fs-4">
                        <i class="bi bi-journal-text mr-2"></i>
                        Danh sách bài tập
                    </h4>
                    <p class="text-muted mb-0">
                        Xem bài tập, điểm và nhận xét từ giáo viên
                    </p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="row g-3">

                    <!-- Search -->
                    <div class="col-md-4">
                        <label class="form-label">Tìm kiếm</label>

                        <input
                            type="text"
                            class="form-control"
                            wire:model.live="search"
                            placeholder="Tìm theo tên bài tập..."
                        >
                    </div>

                    <!-- Status -->
                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>

                        <select class="form-control" wire:model.live="filterStatus">
                            <option value="all">Tất cả</option>
                            <option value="submitted">Đã nộp</option>
                            <option value="unsubmitted">Chưa nộp</option>
                        </select>
                    </div>

                    <!-- Classroom -->
                    <div class="col-md-3">
                        <label class="form-label">Lớp học</label>

                        <select class="form-control" wire:model.live="filterClassroom">
                            <option value="">Tất cả</option>

                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Teacher -->
                    <div class="col-md-3">
                        <label class="form-label">Giáo viên</label>

                        <select class="form-control" wire:model.live="filterTeacher">
                            <option value="">Tất cả</option>

                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Time Filter -->
                <div class="row g-3 mt-2">

                    <div class="col-md-3">
                        <label class="form-label">Khoảng thời gian</label>

                        <select class="form-control" wire:model.live="filterTimeRange">
                            <option value="all">Tất cả</option>
                            <option value="today">Hôm nay</option>
                            <option value="week">Tuần này</option>
                            <option value="month">Tháng này</option>
                            <option value="custom">Tùy chỉnh</option>
                        </select>
                    </div>


                    <div class="col-md-3 d-flex align-items-end">
                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            wire:click="resetFilters"
                        >
                            <i class="bi bi-arrow-clockwise"></i>
                            Đặt lại bộ lọc
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <!-- Assignment List -->
        <div class="card shadow-sm">

            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="bi bi-list-ul mr-2"></i>
                    Danh sách bài tập
                </h6>
            </div>

            <div class="card-body">

                @if ($assignments->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Lớp học</th>
                                    <th>Giáo viên</th>
                                    <th>Hạn nộp</th>
                                    <th>Trạng thái</th>
                                    <th>Điểm</th>
                                    <th>Nhận xét</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($assignments as $assignment)

                                    @php
                                        $submitted = $this->isSubmitted($assignment);

                                        $score = $this->getScore($assignment);

                                        $feedback = $this->getFeedback($assignment);
                                    @endphp

                                    <tr>

                                        <!-- Title -->
                                        <td>
                                            <div class="fw-medium">
                                                {{ $assignment->title }}
                                            </div>

                                            @if ($assignment->description)
                                                <small class="text-muted">
                                                    {{ \Illuminate\Support\Str::limit($assignment->description, 80) }}
                                                </small>
                                            @endif
                                        </td>

                                        <!-- Classroom -->
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $assignment->classroom?->name ?? '-' }}
                                            </span>
                                        </td>

                                        <!-- Teacher -->
                                        <td>
                                            @if ($assignment->classroom?->teachers?->count())

                                                @foreach ($assignment->classroom->teachers as $teacher)
                                                    <span class="badge bg-secondary">
                                                        {{ $teacher->name }}
                                                    </span>
                                                @endforeach

                                            @else
                                                <span class="text-muted">
                                                    Chưa có giáo viên
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Deadline -->
                                        <td>
                                            <div class="fw-medium">
                                                {{ $assignment->deadline?->format('d/m/Y H:i') }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $assignment->deadline?->diffForHumans() }}
                                            </small>
                                        </td>

                                        <!-- Status -->
                                        <td>

                                            @if ($submitted)

                                                <span class="badge bg-success">
                                                    Đã nộp
                                                </span>

                                            @else

                                                <span class="badge bg-warning text-dark">
                                                    Chưa nộp
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Score -->
                                        <td>

                                            @if ($score !== null)

                                                <span class="badge bg-primary">
                                                    {{ $score }}/10
                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    Chưa có điểm
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Feedback -->
                                        <td style="max-width: 250px;">

                                            @if ($feedback)

                                                <small class="text-dark">
                                                    {{ $feedback }}
                                                </small>

                                            @else

                                                <small class="text-muted">
                                                    Chưa có nhận xét
                                                </small>

                                            @endif

                                        </td>

                                        <!-- Actions -->
                                        <td>

                                            <a
                                                href="{{ route('student.assignments.show', $assignment->id) }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                <i class="bi bi-eye"></i>
                                                Chi tiết
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $assignments->links('vendor.pagination.bootstrap-5') }}
                    </div>

                @else

                    <div class="text-center py-5">

                        <i class="bi bi-journal-x fs-1 text-muted mb-3"></i>

                        <h5 class="text-muted">
                            Không có bài tập
                        </h5>

                    </div>

                @endif

            </div>

        </div>

    </div>
</x-layouts.dash-student>