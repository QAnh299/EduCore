<x-layouts.dash-assistant active="grade-entry" title="Chi tiết điểm">

<div class="container mt-4">

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('assistant.grade-entry-assistant.index') }}"
           class="btn btn-outline-secondary d-inline-flex align-items-center">
            ← Quay lại
        </a>
        <a href="{{ route('assistant.grade-entry-assistant.create', $student->id) }}"
           class="btn btn-primary">
            + Thêm điểm
        </a>
    </div>

    <h4 class="mb-3">
        Điểm của học viên: <strong>{{ $student->name }}</strong>
    </h4>

    <!-- Thẻ điểm tổng kết -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white shadow {{ $this->averageScore >= 8 ? 'bg-success' : ($this->averageScore >= 5 ? 'bg-warning' : ($this->averageScore > 0 ? 'bg-danger' : 'bg-secondary')) }}">
                <div class="card-body text-center py-3">
                    <h6 class="card-title mb-1">Điểm tổng kết</h6>
                    <h2 class="mb-0 fw-bold">
                        {{ $this->averageScore > 0 ? number_format($this->averageScore, 2) : '—' }}
                    </h2>
                    <small class="opacity-75">BTVN×10% + Minitest×30% + Cuối tháng×60%</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bộ lọc -->
    <div class="mb-3">
        <select class="form-control w-25" wire:model.live="filter">
            <option value="all">Tất cả</option>
            <option value="homework">Bài về nhà</option>
            <option value="minitest">Minitest</option>
            <option value="monthly_exam">Kiểm tra cuối tháng</option>
        </select>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                        <td>{{ optional($grade->graded_at)->format('d/m/Y') }}</td>
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
                                @default
                                    <span class="badge bg-secondary">{{ $grade->grade_type }}</span>
                            @endswitch
                        </td>
                        <td class="text-start">{{ $grade->assignment?->title ?? '-' }}</td>
                        <td><span class="fw-bold">{{ $grade->score }}</span></td>
                        <td>{{ $grade->teacher?->name ?? '-' }}</td>
                        <td class="text-start">{{ $grade->feedback ?? '-' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('assistant.grade-entry-assistant.edit', $grade->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button wire:click="delete({{ $grade->id }})"
                                    onclick="confirm('Bạn chắc chắn muốn xóa điểm này?') || event.stopImmediatePropagation()"
                                    class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-4 text-muted">Chưa có điểm nào</td></tr>
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
        <div class="p-3">{{ $this->grades->links() }}</div>
    </div>
</div>
</div>

</x-layouts.dash-assistant>
