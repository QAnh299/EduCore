<x-layouts.dash-assistant active="grade-entry" title="Nhập điểm mới">

    @include('components.language')

    <div class="row">
        <div class="col-12">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">
                    <i class="fas fa-edit mr-2"></i>
                    Quản lý điểm
                </h4>

            </div>

            <!-- FILTER -->
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <div class="row g-3">

                        <!-- SEARCH -->
                        <div class="col-md-4">

                            <label for="search" class="form-label">
                                Tìm kiếm học viên
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="search"
                                wire:model.live="search"
                                placeholder="Nhập tên học viên..."
                            >

                        </div>

                        <!-- FILTER CLASS -->
                        <div class="col-md-3">

                            <label for="classroomFilter" class="form-label">
                                {{ __('general.classroom') }}
                            </label>

                            <select
                                class="form-control"
                                id="classroomFilter"
                                wire:model.live="classroomFilter"
                            >

                                <option value="">
                                    {{ __('general.all_classes') }}
                                </option>

                                @foreach ($classrooms as $classroom)

                                    <option value="{{ $classroom->id }}">
                                        {{ $classroom->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- CLEAR FILTER -->
                        <div class="col-md-2">

                            <label class="form-label">
                                &nbsp;
                            </label>

                            <button
                                class="btn btn-outline-secondary w-100"
                                wire:click="clearFilters"
                            >

                                <i class="bi bi-x-circle mr-2"></i>

                                {{ __('general.clear_filters') }}

                            </button>

                        </div>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="card card-outline card-primary">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th>Tên học viên</th>
                                        <th>Lớp học</th>
                                        <th>Điểm trung bình</th>
                                        <th>Xếp hạng</th>
                                        <th width="140">Thao tác</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($students as $student)

                                        @php
                                            $studentRank = $this->getStudentRank(
                                                $student->id,
                                            );
                                        @endphp

                                        <tr>

                                            <!-- TÊN -->
                                            <td class="fw-semibold">
                                                {{ $student->name }}
                                            </td>

                                            <!-- LỚP -->
                                            <td>

                                                @forelse ($student->classrooms as $classroom)

                                                    <span class="badge bg-primary me-1">
                                                        {{ $classroom->name }}
                                                    </span>

                                                @empty

                                                    <span class="text-muted">
                                                        Chưa có lớp
                                                    </span>

                                                @endforelse

                                            </td>

                                            <!-- ĐIỂM TB -->
                                            <td>

                                                @if($student->average_score !== null)

                                                    <span class="fw-bold text-primary">
                                                        {{ number_format($student->average_score, 1) }}
                                                    </span>

                                                @else

                                                    <span class="text-muted">
                                                        Chưa có điểm
                                                    </span>

                                                @endif

                                            </td>

                                            <!-- XẾP HẠNG -->
                                            <td>

                                                @if($studentRank)

                                                    <span class="badge bg-warning text-dark">
                                                        #{{ $studentRank }}
                                                    </span>

                                                @else

                                                    <span class="text-muted">
                                                        Chưa có xếp hạng
                                                    </span>

                                                @endif

                                            </td>

                                            <!-- ACTION -->
                                            <td>

                                                <a
                                                    href="{{ route('assistant.grade-entry-assistant.show', $student->id) }}"
                                                    class="btn btn-sm btn-info"
                                                >
                                                    Xem chi tiết
                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="text-center py-4">

                                                <div class="text-muted">
                                                    Không có dữ liệu
                                                </div>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $students->links() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-layouts.dash-assistant>