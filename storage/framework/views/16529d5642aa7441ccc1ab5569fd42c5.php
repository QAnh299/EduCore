<?php if (isset($component)) { $__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-admin','data' => ['active' => 'classrooms']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'classrooms']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        /* Days Selector Styling */
        .days-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .day-item {
            position: relative;
        }

        .day-checkbox {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .day-label {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            color: #6c757d;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
            min-width: 80px;
            text-align: center;
        }

        .day-label:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .day-checkbox:checked+.day-label {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        .day-checkbox:checked+.day-label:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .day-checkbox:focus+.day-label {
            outline: 2px solid #80bdff;
            outline-offset: 2px;
        }

        /* Animation when checking */
        .day-checkbox:checked+.day-label {
            animation: checkBounce 0.3s ease;
        }

        @keyframes checkBounce {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .days-selector {
                gap: 6px;
            }

            .day-label {
                padding: 6px 12px;
                font-size: 13px;
                min-width: 70px;
            }
        }

        /* Teacher Dropdown Styling */
        .dropdown-menu {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 8px 16px;
            transition: background-color 0.2s ease;
            cursor: pointer;
            color: #495057 !important;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa !important;
            color: #495057 !important;
        }

        .dropdown-item:focus {
            background-color: #f8f9fa !important;
            color: #495057 !important;
        }

        .dropdown-item:active {
            background-color: #e9ecef !important;
            color: #495057 !important;
        }

        .dropdown-item input[type="checkbox"] {
            transform: scale(1.1);
            margin-right: 8px;
        }

        .dropdown-toggle::after {
            display: none;
        }

        /* Custom button styling for teacher selector */
        .btn-outline-secondary {
            border-color: #ced4da;
            color: #495057;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        .btn-outline-secondary:focus {
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        }

        /* Rotation animation for chevron */
        .fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .fa-rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <a href="<?php echo e(route('classrooms.index')); ?>" class="text-decoration-none text-secondary d-inline-block mb-3">
                <i class="bi bi-arrow-left mr-2"></i><?php echo app('translator')->get('general.back'); ?>
            </a>
            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-pencil-square mr-2"></i><?php echo app('translator')->get('general.edit_classroom'); ?>
            </h4>
        </div>

        <!-- Flash Messages -->
        <!--[if BLOCK]><![endif]--><?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle mr-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle mr-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Form Card Centered with Illustration -->
        <div class="card shadow-sm p-0">
            <div class="row g-0 align-items-stretch">
                <div class="col-md-7 p-4">
                    <form wire:submit="save">
                        <!-- Thông tin cơ bản -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><?php echo app('translator')->get('general.classroom_information'); ?></h5>
                            <div class="mb-3">
                                <label for="name" class="form-label"><?php echo app('translator')->get('general.classroom_name'); ?> <span
                                        class="text-danger">*</span></label>
                                <input wire:model="name" type="text"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name"
                                    placeholder="<?php echo app('translator')->get('general.example_class_name'); ?>">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label"><?php echo app('translator')->get('general.level'); ?> <span
                                        class="text-danger">*</span></label>
                                <select wire:model="level" class="form-control <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="level">
                                    <option value=""><?php echo app('translator')->get('general.choose_level'); ?></option>
                                    <option value="Toán lớp 6">Lớp 6A</option>
                                    <option value="Toán lớp 6">Lớp 6B</option>
                                    <option value="Toán lớp 7">Lớp 7A</option>
                                    <option value="Toán lớp 7">Lớp 7B</option>
                                    <option value="Toán lớp 8">Lớp 8A</option>
                                    <option value="Toán lớp 8">Lớp 8B</option>
                                    <option value="Toán lớp 9">Lớp 9A</option>
                                    <option value="Toán lớp 9">Lớp 9B</option>
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mb-3">
                                <label for="teacher_ids" class="form-label"><?php echo app('translator')->get('general.teacher'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="dropdown" x-data="{ open: false }" @click.away="open = false">
                                    <button
                                        class="form-control w-100 d-flex justify-content-between align-items-center text-left"
                                        type="button" @click="open = !open" aria-haspopup="true" style="height: 48px;">
                                        <span class="text-truncate">
                                            <!--[if BLOCK]><![endif]--><?php if(count($teacher_ids)): ?>
                                                <?php echo e(collect($teachers)->whereIn('id', $teacher_ids)->pluck('name')->join(', ')); ?>

                                            <?php else: ?>
                                                <?php echo app('translator')->get('general.select_teacher'); ?>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </span>
                                        <span class="ml-2"><i class="fas fa-chevron-down"
                                                :class="{ 'fa-rotate-180': open }"></i></span>
                                    </button>
                                    <div class="dropdown-menu w-100" :class="{ 'show': open }"
                                        style="max-height: 300px; overflow-y: auto;" @click.stop>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="dropdown-item mb-0 d-flex align-items-center" @click.stop>
                                                <input type="checkbox" value="<?php echo e($teacher->id); ?>"
                                                    wire:model.live="teacher_ids" class="mr-2" @click.stop>
                                                <span><?php echo e($teacher->name); ?></span>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['teacher_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label"><?php echo app('translator')->get('general.status'); ?> <span
                                        class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="status">
                                    <option value="draft"><?php echo app('translator')->get('general.draft'); ?></option>
                                    <option value="active"><?php echo app('translator')->get('general.active'); ?></option>
                                    <option value="inactive"><?php echo app('translator')->get('general.inactive'); ?></option>
                                    <option value="completed"><?php echo app('translator')->get('general.completed'); ?></option>
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('general.study_days'); ?> <span class="text-danger">*</span></label>
                                <div class="days-selector">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [
        'Monday' => __('general.monday'),
        'Tuesday' => __('general.tuesday'),
        'Wednesday' => __('general.wednesday'),
        'Thursday' => __('general.thursday'),
        'Friday' => __('general.friday'),
        'Saturday' => __('general.saturday'),
        'Sunday' => __('general.sunday'),
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="day-item">
                                            <input wire:model="days" class="day-checkbox" type="checkbox"
                                                value="<?php echo e($value); ?>" id="day_<?php echo e($value); ?>"
                                                <?php echo e(in_array($value, $days) ? 'checked' : ''); ?>>
                                            <label class="day-label" for="day_<?php echo e($value); ?>">
                                                <?php echo e($label); ?>

                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Thời gian học -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="startTime" class="form-label"><?php echo app('translator')->get('general.start_time'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input type="time" wire:model="startTime"
                                        class="form-control <?php $__errorArgs = ['startTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="startTime">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['startTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-6">
                                    <label for="endTime" class="form-label"><?php echo app('translator')->get('general.end_time'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input type="time" wire:model="endTime"
                                        class="form-control <?php $__errorArgs = ['endTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="endTime">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['endTime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>

                            <!-- Cảnh báo trùng lịch real-time -->
                            <!--[if BLOCK]><![endif]--><?php if($realTimeValidation && !empty($teacherConflicts)): ?>
                                <div class="mb-3">
                                    <div class="alert alert-warning border-warning">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-exclamation-triangle-fill text-warning mr-2 mt-1"></i>
                                            <div>
                                                <strong><?php echo app('translator')->get('general.schedule_conflict_warning'); ?></strong>
                                                <div class="small mt-1">
                                                    <?php echo app('translator')->get('general.conflict_detected_message'); ?>
                                                </div>
                                                <div class="mt-2">
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teacherConflicts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherId => $conflictData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="small text-danger mb-1">
                                                            <strong><?php echo e($conflictData['teacher']->name); ?>:</strong>
                                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $conflictData['conflicts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conflict): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($conflict['message']); ?>

                                                                <!--[if BLOCK]><![endif]--><?php if($conflict['overlapTime']): ?>
                                                                    (<?php echo app('translator')->get('general.overlap_time'); ?>: <?php echo e($conflict['overlapTime']); ?>)
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <div class="mb-3">
                                <label for="notes" class="form-label"><?php echo app('translator')->get('general.description'); ?></label>
                                <textarea wire:model="notes" class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="notes" rows="3"
                                    placeholder="<?php echo app('translator')->get('general.enter_classroom_description'); ?>"></textarea>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo e(route('classrooms.index')); ?>" class="btn btn-light"><?php echo app('translator')->get('general.cancel'); ?></a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save mr-2"></i><?php echo app('translator')->get('general.save_changes'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <div
                    class="col-md-5 d-flex flex-column justify-content-center align-items-center bg-light border-start rounded-end p-4">
                    <img src="/smash-logo.png" alt="<?php echo app('translator')->get('general.edit_classroom'); ?>" class="mb-3" style="max-width: 90px;">
                    <div class="text-center">
                        <h6 class="text-primary fw-bold mb-2"><?php echo app('translator')->get('general.edit_classroom'); ?></h6>
                        <p class="text-muted small mb-0"><?php echo app('translator')->get('general.edit_classroom_description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cảnh báo trùng lịch giáo viên -->
    <!--[if BLOCK]><![endif]--><?php if($showConflictModal): ?>
    <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Cảnh báo xung đột lịch học
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeConflictModal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="conflicts-list" style="max-height: 400px; overflow-y: auto;">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teacherConflicts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherId => $conflictData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card border-warning mb-4 shadow-sm">
                                <div class="card-header bg-light border-warning">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-person-circle text-primary"></i>
                                        <span class="text-dark">Giáo viên: <strong><?php echo e($conflictData['teacher']->name); ?></strong></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-x me-4 text-warning"></i>
                                        <span class="text-dark">Các lớp học xung đột:</span> 
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $conflictData['conflicts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conflict): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="text-dark"><?php echo e($conflict['classroom']->name); ?></span>
                                            <!--[if BLOCK]><![endif]--><?php if(!$loop->last): ?>, <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $conflictData['conflicts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conflict): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!--[if BLOCK]><![endif]--><?php if($conflict['overlapTime']): ?>
                                                <div class="mb-3">
                                                    <i class="bi bi-clock me-3 text-success"></i>
                                                    <span class="text-success fw-semibold">Thời gian trùng: <?php echo e($conflict['overlapTime']); ?></span>
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <div class="mb-3">
                                                <i class="bi bi-exclamation-triangle me-3 text-danger"></i>
                                                <span class="text-danger"><?php echo e($conflict['message']); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="alert alert-info border-0 mt-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle fs-4"></i>
                            <div class="flex-grow-1">
                                <strong>Lưu ý:</strong> Vui lòng chọn giáo viên khác hoặc thay đổi lịch học để tránh xung đột.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary px-4" wire:click="closeConflictModal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe)): ?>
<?php $attributes = $__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe; ?>
<?php unset($__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe)): ?>
<?php $component = $__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe; ?>
<?php unset($__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/admin/classrooms/edit.blade.php ENDPATH**/ ?>