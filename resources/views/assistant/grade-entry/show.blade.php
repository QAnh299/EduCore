<x-layouts.dash-assistant active="grade-entry" title="Chi tiết điểm">

<div class="container mt-4">

    <!-- Nút quay lại -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('assistant.grade-entry-assistant.index') }}"
           class="btn btn-outline-secondary d-inline-flex align-items-center">
            ← Quay lại
        </a>

        <!-- Nút thêm điểm -->
        <a href="{{ route('assistant.grade-entry-assistant.create', $student->id) }}"
           class="btn btn-primary">
            + Thêm điểm
        </a>
    </div>

    <h4 class="mb-3">
        Điểm của học viên: <strong>{{ $student->name }}</strong>
    </h4>

    <!-- Bộ lọc -->
    <div class="mb-3">
        <select class="form-control w-25" wire:model.live="filter">
            <option value="all">Tất cả</option>
            <option value="homework">Bài về nhà</option>
            <option value="minitest">Minitest</option>
            <option value="monthly">Kiểm tra cuối tháng</option>
        </select>
    </div>

    <!-- Bảng điểm -->
    <div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th style="width:120px;">Ngày</th>
                    <th style="width:130px;">Loại</th>
                    <th>Bài tập</th>
                    <th style="width:90px;">Điểm</th>
                    <th style="width:150px;">Giáo viên</th>
                    <th>Nhận xét</th>
                    <th style="width:140px;">Thao tác</th>
                </tr>
            </thead>

            <tbody class="text-center">
            @if($this->gradesCount > 0)
                @forelse ($this->grades as $grade)
                    <tr>
                        <!-- Ngày -->
                        <td>
                            {{ optional($grade->graded_at)->format('d/m/Y') }}
                        </td>

                        <!-- Loại -->
                        <td>
                            @switch($grade->grade_type)
                                @case('homework')
                                    <span class="badge bg-primary">BTVN</span>
                                    @break
                                @case('minitest')
                                    <span class="badge bg-warning text-dark">Minitest</span>
                                    @break
                                @case('monthly_exam')
                                    <span class="badge bg-success">Cuối tháng</span>
                                    @break
                            @endswitch
                        </td>

                        <!-- Bài tập -->
                        <td class="text-start">
                            {{ $grade->assignment?->title ?? '-' }}
                        </td>

                        <!-- Điểm -->
                        <td>
                            <span class="fw-bold">
                                {{ $grade->score }}
                            </span>
                        </td>

                        <!-- Giáo viên -->
                        <td>
                            {{ $grade->assistant?->name ?? '-' }}
                        </td>

                        <!-- Nhận xét -->
                        <td class="text-start">
                            {{ $grade->feedback ?? '-' }}
                        </td>

                        <!-- Thao tác -->
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('assistant.grade-entry-assistant.edit', $grade->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button wire:click="delete({{ $grade->id }})" 
                                onclick="confirm('Bạn chắc chắn muốn xóa điểm này?') || event.stopImmediatePropagation()"
                                class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-muted">
                            Chưa có điểm nào
                        </td>
                    </tr>
                @endforelse
                @else
        <tr>
            <td colspan="7" class="text-center py-4 text-muted">
                @if($filter === 'all')
                    Học viên chưa có điểm nào.
                @else
                    Không có điểm thuộc loại đã chọn.
                @endif
            </td>
        </tr>
    @endif
            </tbody>
        </table>

    </div>
</div>
</div>

</x-layouts.dash-assistant>
