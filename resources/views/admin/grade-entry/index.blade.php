<x-layouts.dash-admin active="grade-entry" title="Nhập điểm mới">

    @include('components.language')

    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fas fa-edit mr-2"></i>Quản lý điểm
                </h4>
            </div>
            <!--Filter-->
            <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <!--tìm theo tên-->
                    <div class="col-md-4">
                        <label for="search" class="form-label">Tìm kiếm học viên</label>
                        <input type="text" class="form-control" id="search" wire:model.live="search"
                            placeholder="Nhập tên học viên...">
                    </div>
                    <!--Lọc theo lớp-->
                    <div class="col-md-3">
                        <label for="classroomFilter" class="form-label">{{ __('general.classroom') }}</label>
                        <select class="form-control" id="classroomFilter" wire:model.live="classroomFilter">
                            <option value="">{{ __('general.all_classes') }}</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button class="btn btn-outline-secondary w-100" wire:click="clearFilters">
                            <i class="bi bi-x-circle mr-2"></i>{{ __('general.clear_filters') }}
                        </button>
                    </div>
                </div>
            </div>
        <!--</div>-->


            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên học viên</th>
                                    <th>Lớp học</th>
                                    <th>Điểm trung bình</th>
                                    <th>Xếp hạng</th>
                                    <th>Thao tác</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        @foreach ($student->classrooms as $classroom)
                                            <span class="badge bg-primary">{{ $classroom->name }}</span>
                                        @endforeach
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('grade-entry.show', $student->id) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Không có dữ liệu
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>

</x-layouts.dash-admin>