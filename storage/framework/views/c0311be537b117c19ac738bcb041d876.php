<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'attendances']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'attendances']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <a href="<?php echo e(route('teacher.my-class.index')); ?>"
                class="text-decoration-none text-secondary d-inline-block mb-3">
                <i class="bi bi-arrow-left mr-2"></i><?php echo e(__('general.back_to_classes')); ?>

            </a>
            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-calendar-check mr-2"></i><?php echo e(__('general.attendance')); ?> - <?php echo e($classroom->name); ?>

            </h4>
        </div>

        <!-- Thống kê nhanh -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.total_students')); ?></h6>
                                <h3 class="mb-0"><?php echo e($stats['total']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.present')); ?></h6>
                                <h3 class="mb-0"><?php echo e($stats['present']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-check-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.absent')); ?></h6>
                                <h3 class="mb-0"><?php echo e($stats['absent']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-x-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.attendance_rate')); ?></h6>
                                <h3 class="mb-0"><?php echo e($stats['presentPercentage']); ?>%</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-percent fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form điểm danh -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-calendar-event mr-2"></i><?php echo e(__('general.attendance_for_date')); ?>

                            <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>

                        </h5>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <button wire:click="saveAttendance" class="btn btn-primary"
                                <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>>
                                <i class="bi bi-save mr-2"></i><?php echo e(__('general.save_attendance')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('message')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if(!$canTakeAttendance && $attendanceMessage): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle mr-2"></i>
                        <strong><?php echo e(__('general.note')); ?>:</strong> <?php echo e($attendanceMessage); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if(empty($attendanceData)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-people fs-1 text-muted mb-3"></i>
                        <h5 class="text-muted"><?php echo e(__('general.no_students_in_class')); ?></h5>
                        <p class="text-muted"><?php echo e(__('general.please_add_students_before_attendance')); ?></p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th><?php echo e(__('general.student')); ?></th>
                                    <th width="120"><?php echo e(__('general.status')); ?></th>
                                    <th><?php echo e(__('general.absence_reason')); ?></th>
                                    <th width="100"><?php echo e(__('general.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $attendanceData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr wire:key="attendance-<?php echo e($data['student_record']->id); ?>">
                                        <td class="text-center"><?php echo e($index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    <i class="bi bi-person-circle fs-4 text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium"><?php echo e($data['student']->name); ?></div>
                                                    <small class="text-muted"><?php echo e($data['student']->email); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    @click="$dispatch('hide-loading')"
                                                    wire:click="toggleAttendance(<?php echo e($data['student_record']->id); ?>)"
                                                    <?php echo e($data['present'] ? 'checked' : ''); ?>

                                                    <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>

                                                    id="attendance_<?php echo e($data['student_record']->id); ?>">
                                                <label class="form-check-label"
                                                    for="attendance_<?php echo e($data['student_record']->id); ?>">
                                                    <!--[if BLOCK]><![endif]--><?php if($data['present']): ?>
                                                                                                            <span class="badge bg-success"><?php echo e(__('general.present')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger"><?php echo e(__('general.absent')); ?></span>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if(!$data['present']): ?>
                                                <!--[if BLOCK]><![endif]--><?php if($data['reason']): ?>
                                                    <span
                                                        class="text-muted"><?php echo e(Str::limit($data['reason'], 30)); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted"><?php echo e(__('general.no_reason_yet')); ?></span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if(!$data['present']): ?>
                                                <button
                                                    wire:click="openReasonModal(<?php echo e($data['student_record']->id); ?>)"
                                                    class="btn btn-sm btn-outline-primary"
                                                    <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>>
                                                    <i class="bi bi-pencil mr-1"></i><?php echo e(__('general.reason')); ?>

                                                </button>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    <!-- Modal nhập lý do nghỉ -->
    <!--[if BLOCK]><![endif]--><?php if($showReasonModal): ?>
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle mr-2"></i><?php echo e(__('general.absence_reason')); ?>

                        </h5>
                        <button type="button" class="close" wire:click="$set('showReasonModal', false)"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="absenceReason" class="form-label"><?php echo e(__('general.absence_reason')); ?></label>
                            <textarea wire:model="absenceReason" class="form-control" id="absenceReason" rows="3"
                                placeholder="<?php echo e(__('general.enter_absence_reason')); ?>"></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['absenceReason'];
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showReasonModal', false)">
                            <?php echo e(__('general.cancel')); ?>

                        </button>
                        <button type="button" class="btn btn-primary" wire:click="saveReason">
                            <i class="bi bi-check-circle mr-2"></i><?php echo e(__('general.save_reason')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf2c05110f7630f709271885c25ac6f7c)): ?>
<?php $attributes = $__attributesOriginalf2c05110f7630f709271885c25ac6f7c; ?>
<?php unset($__attributesOriginalf2c05110f7630f709271885c25ac6f7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf2c05110f7630f709271885c25ac6f7c)): ?>
<?php $component = $__componentOriginalf2c05110f7630f709271885c25ac6f7c; ?>
<?php unset($__componentOriginalf2c05110f7630f709271885c25ac6f7c); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/attendance/take-attendance.blade.php ENDPATH**/ ?>