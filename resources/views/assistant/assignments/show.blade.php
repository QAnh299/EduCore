<x-layouts.dash-assistant active="assignments">
    @include('components.language')

    <div class="container-fluid">

        <!-- Header -->
        <div class="mb-4">

            <a href="{{ route('assistant.assignments.index') }}"
               class="text-decoration-none text-secondary d-inline-block mb-3">

                <i class="bi bi-arrow-left me-2"></i>
                {{ __('general.back_to_list') }}
            </a>

            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-journal-text me-2"></i>
                {{ __('general.assignment_details') }}
            </h4>

            <p class="text-muted mb-0">
                {{ $assignment->title }}
            </p>
        </div>

        <div class="row">

            <!-- THÔNG TIN BÀI TẬP -->
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ __('general.assignment_info') }}
                        </h5>
                    </div>

                    <div class="card-body">

                        <!-- Tiêu đề -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.title') }}
                            </label>

                            <div class="fw-medium">
                                {{ $assignment->title }}
                            </div>
                        </div>

                        <!-- Lớp học -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.classroom') }}
                            </label>

                            <div class="fw-medium">
                                {{ $classroom->name ?? '-' }}
                            </div>
                        </div>

                        <!-- Hạn nộp -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.deadline') }}
                            </label>

                            <div class="fw-medium">
                                {{ $assignment->deadline
                                    ? $assignment->deadline->format('d/m/Y H:i')
                                    : '-' }}
                            </div>
                        </div>

                        <!-- Ngày tạo -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.assigned_at') }}
                            </label>

                            <div class="fw-medium">
                                {{ $assignment->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.description') }}
                            </label>

                            <div class="fw-medium">
                                {!! nl2br(e($assignment->description)) !!}
                            </div>
                        </div>

                        <!-- File -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.attachment') }}
                            </label>

                            <div class="fw-medium">

                                @if ($assignment->attachment_path)

                                    <a href="{{ asset('storage/' . $assignment->attachment_path) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-success">

                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                        {{ __('general.download') }}
                                    </a>

                                @else
                                    -
                                @endif

                            </div>
                        </div>

                        <!-- Video -->
                        <div class="mb-3">

                            <label class="form-label text-muted small">
                                {{ __('general.video') }}
                            </label>

                            <div class="fw-medium">

                                @if ($assignment->video_path)

                                    <video width="240"
                                           height="135"
                                           controls>

                                        <source
                                            src="{{ asset('storage/' . $assignment->video_path) }}"
                                            type="video/mp4">

                                        {{ __('general.browser_not_support') }}
                                    </video>

                                @else
                                    -
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- DANH SÁCH HỌC VIÊN -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-people me-2"></i>
                            {{ __('general.students_and_submission_status') }}
                        </h5>
                    </div>

                    <div class="card-body">

                        @if ($students->count() > 0)

                            <!-- SUCCESS -->
                            @if (session()->has('success'))

                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>

                            @endif

                            <!-- ERROR -->
                            @if (session()->has('error'))

                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>

                            @endif

                            <div class="table-responsive">

                                <table class="table table-hover align-middle">

                                    <thead class="table-light">

                                        <tr>
                                            <th>
                                                {{ __('general.student') }}
                                            </th>

                                            <th>
                                                {{ __('general.email') }}
                                            </th>

                                            <th>
                                                {{ __('general.submission_status') }}
                                            </th>

                                            <th width="180">
                                                {{ __('general.score') }}
                                            </th>

                                            <th>
                                                Nhận xét
                                            </th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($students as $student)

                                            @php
                                                $status = $this->getSubmissionStatus($student);
                                            @endphp

                                            <tr>

                                                <!-- Tên -->
                                                <td>
                                                    {{ $student->name }}
                                                </td>

                                                <!-- Email -->
                                                <td>
                                                    {{ $student->email }}
                                                </td>

                                                <!-- Trạng thái -->
                                                <td>

                                                    <span class="badge {{ $status['class'] }}">
                                                        {{ $status['label'] }}
                                                    </span>

                                                </td>

                                                <!-- Điểm -->
                                                <td>

                                                    <input
                                                        type="number"
                                                        step="0.1"
                                                        min="0"
                                                        max="10"
                                                        wire:model.live="scores.{{ $student->id }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="{{ __('general.score') }}"
                                                    >

                                                </td>

                                                <!-- Nhận xét -->
                                                <td>

                                                    <input
                                                        type="text"
                                                        wire:model.live="comments.{{ $student->id }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="{{ __('general.comment') }}"
                                                    >

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                                <!-- BUTTON -->
                                <div class="mt-3 text-end">

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        wire:click="updateScore">

                                        <i class="bi bi-save me-1"></i>
                                        Lưu điểm
                                    </button>

                                </div>

                            </div>

                        @else

                            <div class="alert alert-info mb-0">

                                <i class="bi bi-info-circle me-2"></i>

                                {{ __('general.no_students_in_class') }}

                            </div>

                        @endif

                    </div>
                </div>

            </div>

        </div>

    </div>

</x-layouts.dash-assistant>