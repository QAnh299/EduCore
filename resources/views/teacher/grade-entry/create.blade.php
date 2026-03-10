<x-layouts.dash-teacher active="grade-entry" title="Nhập điểm mới">

    @include('components.language')

    <div class="row">
        <div class="col-12">
            <div class="container mt-4">
    <div class="mb-3">
    <a href="{{ route('teacher.grade-entry-teacher.show', $student->id) }}"
       class="btn btn-outline-secondary d-inline-flex align-items-center">
        <span class="me-2">←</span> Quay lại
    </a>
</div>
    <h4 class="mb-4">Nhập điểm học viên</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save">

        <!-- Loại điểm -->
        <div class="mb-3">
            <label class="form-label">Loại điểm</label>
            <select class="form-control" wire:model.live="grade_type">
                <option value="">-- Chọn loại điểm --</option>
                <option value="homework">Bài về nhà</option>

                <option value="minitest">Minitest</option>
                <option value="monthly_exam">Kiểm tra cuối tháng</option>
            </select>
            @error('type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <!--hiện bài tập về nhà nếu chọn homework-->
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

        <!-- Lớp -->
            <div class="mb-3">
                <label class="form-label">Lớp học</label>
                <input type="text"class="form-control" value="{{ $classroom->name }}" disabled>
            </div>

        <!-- Học viên -->
        <div class="mb-3">
            <label class="form-label">Học viên</label>
            <input type="text" class="form-control" value="{{ $student->name }}" disabled>
        </div>

        <!-- Người chấm -->
        <div class="mb-3">
            <label class="form-label">Người chấm</label>
            <select class="form-control" wire:model="teacher_id">
                <option value="">-- Chọn người chấm --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            @error('grader_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Điểm -->
        <div class="mb-3">
            <label class="form-label">Điểm (0 - 10)</label>
            <input type="number"
                   step="0.25"
                   min="0"
                   max="10"
                   class="form-control"
                   wire:model="score">
            @error('score') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Ngày chấm -->
        <div class="mb-3">
            <label class="form-label">Ngày chấm</label>
            <input type="date"
                   max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                   class="form-control"
                   wire:model="graded_at">
            @error('graded_at') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Nhận xét -->
        <div class="mb-3">
            <label class="form-label">Nhận xét</label>
            <textarea class="form-control"
                      wire:model="feedback"
                      rows="3"></textarea>
            @error('comment') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="text-align: left;">
            Lưu điểm
        </button>

    </form>
</div>
    </div>
</div>
</x-layouts.dash-teacher>

