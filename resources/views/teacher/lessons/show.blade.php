<x-layouts.dash-teacher active="lessons">
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

    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 text-primary fs-4">
                        <i class="bi bi-eye mr-2"></i>{{ __('general.lesson_details') }}
                    </h4>
                    <p class="text-muted mb-0">{{ __('general.lesson_detail_description') }}</p>
                </div>
                <div>
                    <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="btn btn-warning mr-2">
                        <i class="bi bi-pencil mr-1"></i>{{ __('general.edit') }}
                    </a>
                    <a href="{{ route('teacher.lessons.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left mr-1"></i>{{ __('general.back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Lesson Details -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="bi bi-file-earmark-text mr-2"></i>{{ __('general.lesson_info') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">{{ __('general.title') }}</label>
                                <p class="mb-0">{{ $lesson->title }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">{{ __('general.lesson_number') }}</label>
                                <p class="mb-0">
                                    @if ($lesson->number)
                                        <span class="badge bg-info">{{ $lesson->number }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ __('general.class') }}</label>
                                <p class="mb-0">
                                    <span class="badge bg-primary">{{ $lesson->classroom->name ?? __('general.not_available') }}</span>
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ __('general.description') }}</label>
                                <div class="mb-0">
                                    @if ($lesson->description)
                                        <div class="description-content">{!! $lesson->description !!}</div>
                                    @else
                                        <span class="text-muted">{{ __('general.no_description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Section -->
                @if ($lesson->video)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-play-circle mr-2"></i>{{ __('general.lesson_video') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <x-video-embed :url="$lesson->video" title="{{ __('general.lesson_video') }}" />
                        </div>
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

</x-layouts.dash-teacher>
