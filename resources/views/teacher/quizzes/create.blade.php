<x-layouts.dash-teacher active="quizzes">
    @include('components.language')

    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('teacher.quizzes.index') }}"
               class="text-decoration-none text-secondary d-inline-block mb-3">
                <i class="bi bi-arrow-left me-3" ></i>{{ __('general.back') }}
            </a>
            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-plus-circle me-2"></i>{{ __('Tạo bài tập Quiz mới ') }}
            </h4>
            <p class="text-muted mb-0">{{ __('general.add_new_quiz_desc') }}</p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form wire:submit="save">
            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-info-circle me-2"></i>{{ __('Thông tin bài tập Quiz') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Tiêu đề') }} <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror"
                                       wire:model="title" 
                                       placeholder="{{ __('Nhập tiêu đề') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('general.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          wire:model="description" 
                                          rows="3"
                                          placeholder="{{ __('Nhập mô tả') }}"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('general.classroom') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('class_id') is-invalid @enderror"
                                        wire:model="class_id">
                                    <option value="">{{ __('general.choose_class') }}</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('general.deadline') }}</label>
                                <input type="datetime-local"
                                       class="form-control @error('deadline') is-invalid @enderror" 
                                       wire:model="deadline"
                                       min="{{ date('Y-m-d\TH:i') }}">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('general.time_limit_minutes') }}</label>
                                <input type="number" 
                                       class="form-control @error('time_limit') is-invalid @enderror"
                                       wire:model="time_limit" 
                                       min="1" max="480"
                                       placeholder="{{ __('general.enter_time_limit_example') }}">
                                <small class="form-text text-muted">{{ __('general.no_time_limit_hint') }}</small>
                                @error('time_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phần thêm câu hỏi -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>{{ __('general.add_new_question') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('general.question_content') }} <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('currentQuestion.question') is-invalid @enderror"
                                            wire:model="currentQuestion.question" 
                                            rows="3" 
                                            placeholder="{{ __('general.question_content') }}..."></textarea>
                                        @error('currentQuestion.question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('general.question_type') }} <span class="text-danger">*</span></label>
                                        <select class="form-control @error('currentQuestion.type') is-invalid @enderror"
                                            wire:model="currentQuestion.type">
                                            <option value="multiple_choice">{{ __('general.multiple_choice') }}</option>
                                        </select>
                                        @error('currentQuestion.type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('general.score') }} <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control @error('currentQuestion.score') is-invalid @enderror"
                                            wire:model="currentQuestion.score" 
                                            min="1" max="10">
                                        @error('currentQuestion.score')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Options cho trắc nghiệm -->
                            @if ($currentQuestion['type'] === 'multiple_choice')
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.answer_options') }} <span class="text-danger">*</span></label>
                                    @foreach ($currentQuestion['options'] as $index => $option)
                                        <div class="input-group mb-2">
                                            <input type="text"
                                                class="form-control @error('currentQuestion.options.' . $index) is-invalid @enderror"
                                                wire:model.live="currentQuestion.options.{{ $index }}"
                                                placeholder="{{ __('general.answer_number', ['number' => $index + 1]) }}">
                                            @if (count($currentQuestion['options']) > 2)
                                                <button type="button" class="btn btn-outline-danger"
                                                    wire:click="removeOption({{ $index }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        wire:click="addOption">
                                        <i class="bi bi-plus me-1"></i>{{ __('general.add_answer') }}
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.correct_answer') }} <span class="text-danger">*</span></label>
                                    <select class="form-control @error('currentQuestion.correct_answer') is-invalid @enderror"
                                        wire:model.live="currentQuestion.correct_answer">
                                        <option value="">{{ __('general.choose_correct_answer') }}</option>
                                        @foreach ($currentQuestion['options'] as $index => $option)
                                            <option value="{{ $option }}">{{ $option ?: __('general.answer_number', ['number' => $index + 1]) }}</option>
                                        @endforeach
                                    </select>
                                    @error('currentQuestion.correct_answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="text-end">
                                @if ($editingIndex !== null)
                                    <button type="button" class="btn btn-warning me-2"
                                        wire:click="resetCurrentQuestion">
                                        <i class="bi bi-x-circle me-2"></i>{{ __('general.cancel_edit') }}
                                    </button>
                                    <button type="button" class="btn btn-primary" wire:click="addQuestion">
                                        <i class="bi bi-check-circle me-2"></i>{{ __('general.update_question') }}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" wire:click="addQuestion">
                                        <i class="bi bi-plus-circle me-2"></i>{{ __('general.add_question_btn') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Danh sách câu hỏi đã thêm -->
                    @if (count($questions) > 0)
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="bi bi-list-ul me-2"></i>
                                    {{ __('general.question_list', ['count' => count($questions)]) }}
                                </h6>
                            </div>
                            <div class="card-body">
                                @foreach ($questions as $index => $question)
                                    <div class="border rounded p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <span class="badge bg-primary me-2">Câu {{ $index + 1 }}</span>
                                                <span class="badge bg-secondary">{{ ucfirst($question['type']) }}</span>
                                                <span class="badge bg-info">{{ $question['score'] ?? 1 }} pts</span>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-outline-warning"
                                                    wire:click="editQuestion({{ $index }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                @if ($index > 0)
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        wire:click="moveQuestionUp({{ $index }})">
                                                        <i class="bi bi-arrow-up"></i>
                                                    </button>
                                                @endif
                                                @if ($index < count($questions) - 1)
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        wire:click="moveQuestionDown({{ $index }})">
                                                        <i class="bi bi-arrow-down"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-outline-danger"
                                                    wire:click="removeQuestion({{ $index }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="fw-medium">{{ $question['question'] }}</div>
                                        @if ($question['type'] === 'multiple_choice' && !empty($question['options']))
                                            <div class="mt-2 small text-muted">
                                                Đáp án đúng: <strong>{{ $question['correct_answer'] }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-end">
                            <a href="{{ route('teacher.quizzes.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-x-circle me-2"></i>{{ __('general.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary" @if (count($questions) === 0) disabled @endif>
                                <i class="bi bi-save me-2"></i>{{ __('Lưu bài tập Quiz') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Script cảnh báo rời trang khi có thay đổi -->
    <script>
        (function() {
            let isDirty = false;

            document.addEventListener('input', () => isDirty = true, { passive: true });
            document.addEventListener('change', () => isDirty = true, { passive: true });

            window.addEventListener('beforeunload', function(e) {
                if (isDirty) {
                    e.preventDefault();
                    e.returnValue = '';
                    return '';
                }
            });
        })();
    </script>
</x-layouts.dash-teacher>