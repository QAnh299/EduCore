<x-layouts.dash-student active="assignments">

    @include('components.language')

    <div class="container-fluid">

        @php
            $status = $this->getStatusBadge();
        @endphp

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="text-primary mb-1">
                    <i class="bi bi-journal-text me-2"></i>
                    {{ $assignment->title }}
                </h4>

                <small class="text-muted">
                    {{ $assignment->classroom?->name }}
                </small>
            </div>

            <span class="badge {{ $status['class'] }}">
                {{ $status['text'] }}
            </span>

        </div>

        <div class="row">

            <!-- LEFT -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            Chi tiết bài tập
                        </h5>
                    </div>

                    <div class="card-body">

                        <!-- MÔ TẢ -->
                        <div class="mb-4">

                            <h6 class="fw-bold mb-2">
                                Mô tả bài tập
                            </h6>

                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($assignment->description)) !!}
                            </div>

                        </div>

                        <!-- LOẠI BÀI -->
                        @if($assignment->types)

                            <div class="mb-4">

                                <h6 class="fw-bold mb-2">
                                    Loại bài tập
                                </h6>

                                @foreach($assignment->types as $type)

                                    <span class="badge bg-primary me-2 mb-2">

                                        @switch($type)

                                            @case('text')
                                                Văn bản
                                            @break

                                            @case('essay')
                                                Tự luận
                                            @break

                                            @case('image')
                                                Hình ảnh
                                            @break

                                            @case('audio')
                                                Âm thanh
                                            @break

                                            @case('video')
                                                Video
                                            @break

                                            @default
                                                {{ $type }}

                                        @endswitch

                                    </span>

                                @endforeach

                            </div>

                        @endif

                        <!-- FILE -->
                        @if($assignment->attachment_path)

                            <div class="mb-4">

                                <h6 class="fw-bold mb-2">
                                    File bài tập
                                </h6>

                                <a
                                    href="{{ Storage::url($assignment->attachment_path) }}"
                                    target="_blank"
                                    class="btn btn-outline-primary"
                                >
                                    <i class="bi bi-download me-2"></i>
                                    Tải file
                                </a>

                            </div>

                        @endif

                        <!-- VIDEO -->
                        @if($assignment->video_path)

                            <div>

                                <h6 class="fw-bold mb-2">
                                    Video bài giảng
                                </h6>

                                <video controls class="w-100 rounded">

                                    <source
                                        src="{{ Storage::url($assignment->video_path) }}"
                                        type="video/mp4"
                                    >

                                </video>

                            </div>

                        @endif

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-lg-4">

                <!-- THÔNG TIN -->
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Thông tin bài tập
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <small class="text-muted">
                                Hạn nộp
                            </small>

                            <div class="fw-semibold">
                                {{ $assignment->deadline?->format('d/m/Y H:i') }}
                            </div>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted">
                                Giáo viên
                            </small>

                            <div class="fw-semibold">

                                @if($assignment->classroom->teachers->count())

                                    {{ $assignment->classroom->teachers->pluck('name')->join(', ') }}

                                @else

                                    Chưa có giáo viên

                                @endif

                            </div>

                        </div>

                        <div>

                            <small class="text-muted">
                                Trạng thái
                            </small>

                            <div class="fw-semibold">
                                {{ $status['text'] }}
                            </div>

                        </div>

                    </div>
                </div>

                <!-- KẾT QUẢ -->
                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-award me-2"></i>
                            Kết quả chấm điểm
                        </h5>
                    </div>

                    <div class="card-body">

                        @if($grade)

                            <div class="text-center mb-4">

                                <div class="display-3 fw-bold text-primary">
                                    {{ number_format($grade->score, 2) }}/10
                                </div>

                                <p class="text-muted mt-2">
                                    Điểm số của bạn
                                </p>

                            </div>

                            <div>

                                <label class="form-label fw-bold">
                                    Nhận xét của giáo viên
                                </label>

                                <div class="border rounded p-3 bg-light">

                                    {{ $grade->feedback ?? 'Chưa có nhận xét' }}

                                </div>

                            </div>

                        @else

                            <div class="text-center py-4">

                                <i class="bi bi-exclamation-circle text-secondary display-4"></i>

                                <h5 class="mt-3">
                                    Chưa có điểm
                                </h5>

                                <small class="text-muted">
                                    Bài tập chưa được chấm điểm
                                </small>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        <!-- BACK -->
        <div class="mt-4 text-center">

            <a
                href="{{ route('student.assignments.overview') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-2"></i>
                Quay lại
            </a>

        </div>

    </div>

</x-layouts.dash-student>