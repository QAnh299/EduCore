<x-layouts.dash-assistant active="grade-entry" title="Nhập điểm mới">

    @include('components.language')

<div class="row">
    <div class="col-12">
    <div class="container mt-4">
        <h2>Cập nhật thông tin</h2>
    <form wire:submit.prevent="update">
<div class="mb-3">
    <label class="form-label">Loại điểm</label>
    <select class="form-control" wire:model.live="grade_type">
        <option value="">-- Chọn loại điểm --</option>
        <option value="homework">Bài về nhà</option>
        <option value="minitest">Minitest</option>
        <option value="monthly_exam">Kiểm tra cuối tháng</option>
    </select>
    @error('grade_type') <small class="text-danger">{{ $message }}</small> @enderror
</div>

@if ($grade_type === 'homework')
<div class="mb-3">
    <label class="form-label">Bài tập</label>
    <select class="form-control" wire:model="assignment_id">
        <option value="">-- Chọn bài tập --</option>

        @foreach($assignments as $assignment)
        <option value="{{ $assignment->id }}">
            {{ $assignment->title }}

            @if($assignment->deadline)
                (Hạn: {{ $assignment->deadline->format('d/m/Y H:i') }})
            @endif

            - Max: {{ $assignment->max_score }}
        </option>
        @endforeach

    </select>
    @error('assignment_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>
@endif
<div class="mb-3">
<label>Điểm</label>
<input type="number" class="form-control" wire:model="score">
</div>

<div class="mb-3">
<label>Nhận xét</label>
<textarea class="form-control" wire:model="feedback"></textarea>
</div>

<div class="mb-3">
<label>Ngày chấm</label>
<input type="date" class="form-control" wire:model="graded_at">
</div>

<button class="btn btn-primary">Cập nhật</button>

</form>
</div>
</div>
</div>
</x-layouts.dash-assistant>
