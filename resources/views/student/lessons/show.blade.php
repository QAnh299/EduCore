<x-layouts.dash-student active="lessons">
    @include('components.language')

    @push('styles')
        <style>
            .description-content {
                line-height: 1.6;
            }

            .description-content img {
                max-width: 100% !important;
                height: auto !important;
            }

            .description-content table {
                width: 100%;
                border-collapse: collapse;
                margin: 10px 0;
            }

            .description-content table,
            .description-content th,
            .description-content td {
                border: 1px solid #ddd;
            }

            .description-content th,
            .description-content td {
                padding: 8px;
                text-align: left;
            }

            .description-content th {
                background-color: #f8f9fa;
            }
        </style>
    @endpush

    <div class="row">
        <div class="container-fluid">
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 text-primary fs-4">
                            <i class="bi bi-book mr-2"></i>{{ $lesson->title }}
                        </h4>
                        <p class="text-muted mb-0">{{ __('views.student_pages.lessons.show.title') }}</p>
                    </div>
                    <div>
                        <a href="{{ route('student.lessons.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> {{ __('views.student_pages.lessons.show.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <strong class="text-muted">{{ __('views.student_pages.lessons.show.description_label') }}</strong>
                        <div class="mt-1 description-content">{!! $lesson->description !!}</div>
                    </div>

                    @php
                        $isYoutube = $lesson->video && Str::contains($lesson->video, ['youtube.com', 'youtu.be']);
                        $isDrive = $lesson->video && Str::contains($lesson->video, 'drive.google.com/file/d/');
                        $youtubeId = null;
                        $driveId = null;
                        if ($isYoutube) {
                            if (Str::contains($lesson->video, 'youtu.be/')) {
                                $youtubeId = Str::after($lesson->video, 'youtu.be/');
                                $youtubeId = Str::before($youtubeId, '?');
                            } elseif (Str::contains($lesson->video, 'v=')) {
                                $youtubeId = Str::after($lesson->video, 'v=');
                                $youtubeId = Str::before($youtubeId, '&');
                            }
                        }
                        if ($isDrive) {
                            $driveId = Str::between($lesson->video, '/file/d/', '/');
                        }
                    @endphp
                    @if ($lesson->video)
                        <div class="mb-3">
                            <strong class="text-muted">{{ __('views.student_pages.lessons.show.video_label') }}</strong><br>
                            @if ($isYoutube && $youtubeId)
                                <div class="ratio ratio-16x9 rounded overflow-hidden mb-2"
                                    style="position: relative;padding-bottom: 56.25%;">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0"
                                        allowfullscreen
                                        style="position: absolute;top: 0;left: 0; width: 100%;height: 100%;"></iframe>
                                </div>
                            @elseif ($isDrive && $driveId)
                                <div class="ratio ratio-16x9 rounded overflow-hidden mb-2"
                                    style="position: relative;padding-bottom: 56.25%;">
                                    <iframe src="https://drive.google.com/file/d/{{ $driveId }}/preview"
                                        style="position: absolute;top: 0;left: 0; width: 100%;height: 100%;"
                                        allow="autoplay"></iframe>
                                </div>
                            @else
                                <a href="{{ $lesson->video }}" target="_blank" class="btn btn-outline-primary"><i
                                        class="bi bi-play-circle"></i> {{ __('views.student_pages.lessons.show.watch_video') }}</a>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            <div class="mt-4">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (!$completed)
                    <button wire:click="markAsCompleted" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> {{ __('views.student_pages.lessons.show.mark_completed') }}
                    </button>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-check2-circle"></i> {{ __('views.student_pages.lessons.show.already_completed') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        function openPreviewModal() {
            document.getElementById('previewModal').style.display = 'block';
        }

        function closePreviewModal() {
            document.getElementById('previewModal').style.display = 'none';
        }
        window.onclick = function(event) {
            var modal = document.getElementById('previewModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</x-layouts.dash-student>
