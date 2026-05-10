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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 text-primary fs-4">
                    <i class="bi bi-calendar-check mr-2"></i><?php echo e(__('general.attendance_overview')); ?>

                </h4>
                <p class="text-muted mb-0"><?php echo e(__('general.manage_track_attendance')); ?></p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?php echo e(route('teacher.my-class.index')); ?>" class="btn btn-outline-primary">
                    <i class="bi bi-mortarboard mr-2"></i><?php echo e(__('general.my_classes')); ?>

                </a>
            </div>
        </div>

        <!-- Bộ lọc tháng/năm -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-funnel mr-2"></i><?php echo e(__('general.filter_by_month')); ?>

                        </h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-end">
                            <select wire:model.live="selectedMonth" class="form-control" style="max-width: 150px;">
                                <!--[if BLOCK]><![endif]--><?php for($month = 1; $month <= 12; $month++): ?>
                                    <option value="<?php echo e($month); ?>"><?php echo e($this->getMonthName($month)); ?></option>
                                <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                            <select wire:model.live="selectedYear" class="form-control" style="max-width: 120px;">
                                <!--[if BLOCK]><![endif]--><?php for($year = date('Y') - 2; $year <= date('Y') + 1; $year++): ?>
                                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng quan -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.total_students')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['total_students']); ?></h3>
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
                                <h6 class="card-title mb-0"><?php echo e(__('general.classes_teaching')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['total_classes']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-mortarboard fs-1"></i>
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
                                <h6 class="card-title mb-0"><?php echo e(__('general.attendance_sessions')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['total_attendance_days']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-event fs-1"></i>
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
                                <h6 class="card-title mb-0"><?php echo e(__('general.average_rate')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['attendance_rate']); ?>%</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-percent fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê chi tiết -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.total_present')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['total_present']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-check-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title mb-0"><?php echo e(__('general.total_absent')); ?></h6>
                                <h3 class="mb-0"><?php echo e($overviewStats['total_absent']); ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-x-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách lớp học và nút điểm danh -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Top lớp học -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-trophy mr-2"></i><?php echo e(__('general.top_5_classes_most_attendance')); ?>

                        </h5>
                    </div>
                    <div class="card-body">
                        <!--[if BLOCK]><![endif]--><?php if($topClasses->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th><?php echo e(__('general.classroom')); ?></th>
                                            <th class="text-center"><?php echo e(__('general.total_count')); ?></th>
                                            <th class="text-center"><?php echo e(__('general.present')); ?></th>
                                            <th class="text-center"><?php echo e(__('general.rate')); ?></th>
                                            <th class="text-center"><?php echo e(__('general.actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $topClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm mr-3">
                                                            <i class="bi bi-mortarboard fs-4 text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-medium"><?php echo e($classData['classroom']->name); ?>

                                                            </div>
                                                            <small
                                                                class="text-muted"><?php echo e($classData['classroom']->level); ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-secondary"><?php echo e($classData['total_days']); ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-success"><?php echo e($classData['present_days']); ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <!--[if BLOCK]><![endif]--><?php if($classData['attendance_rate'] >= 90): ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e($classData['attendance_rate']); ?>%</span>
                                                    <?php elseif($classData['attendance_rate'] >= 70): ?>
                                                        <span
                                                            class="badge bg-warning"><?php echo e($classData['attendance_rate']); ?>%</span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge bg-danger"><?php echo e($classData['attendance_rate']); ?>%</span>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="<?php echo e(route('teacher.attendance.take', $classData['classroom'])); ?>"
                                                            class="btn btn-sm btn-outline-primary" title="<?php echo e(__('general.new_attendance')); ?>">
                                                            <i class="bi bi-calendar-check"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('teacher.attendance.classroom-history', $classData['classroom'])); ?>"
                                                            class="btn btn-sm btn-outline-info" title="<?php echo e(__('general.attendance_history')); ?>">
                                                            <i class="bi bi-calendar-week"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('teacher.my-class.show', $classData['classroom'])); ?>"
                                                            class="btn btn-sm btn-outline-secondary" title="<?php echo e(__('general.view_details')); ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x fs-1 text-muted mb-3"></i>
                                <h5 class="text-muted"><?php echo e(__('general.no_attendance_data')); ?></h5>
                                <p class="text-muted"><?php echo e(__('general.no_attendance_data_month', ['month' => $this->getMonthName($selectedMonth), 'year' => $selectedYear])); ?></p>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <!-- Điểm danh gần đây -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-clock-history mr-2"></i><?php echo e(__('general.recent_attendance')); ?>

                        </h5>
                        <a href="<?php echo e(route('teacher.attendance.history')); ?>"
                            class="btn btn-sm btn-outline-secondary float-end">
                            <i class="bi bi-calendar-week"></i> <?php echo e(__('general.attendance_history')); ?>

                        </a>
                    </div>
                    <div class="card-body">
                        <!--[if BLOCK]><![endif]--><?php if($recentAttendances->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th><?php echo e(__('general.date')); ?></th>
                                            <th><?php echo e(__('general.classroom')); ?></th>
                                            <th><?php echo e(__('general.student')); ?></th>
                                            <th class="text-center"><?php echo e(__('general.status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-medium"><?php echo e($attendance->date->format('d/m/Y')); ?>

                                                    </div>
                                                    <small
                                                        class="text-muted"><?php echo e($attendance->date->format('D')); ?></small>
                                                </td>
                                                <td>
                                                    <div class="fw-medium">
                                                        <?php echo e($attendance->classroom?->name ?? __('general.not_available')); ?></div>
                                                    <small
                                                        class="text-muted"><?php echo e($attendance->classroom?->level ?? __('general.not_available')); ?></small>
                                                </td>
                                                <td>
                                                    <div class="fw-medium">
                                                        <?php echo e($attendance->student?->user?->name ?? __('general.not_available')); ?>

                                                    </div>
                                                    <small
                                                        class="text-muted"><?php echo e($attendance->student?->user?->email ?? __('general.not_available')); ?></small>
                                                </td>
                                                <td class="text-center">
                                                    <!--[if BLOCK]><![endif]--><?php if($attendance->present): ?>
                                                        <span class="badge bg-success"><?php echo e(__('general.present')); ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger"><?php echo e(__('general.absent')); ?></span>
                                                        <!--[if BLOCK]><![endif]--><?php if($attendance->reason): ?>
                                                            <br><small
                                                                class="text-muted"><?php echo e($attendance->reason); ?></small>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x fs-1 text-muted mb-3"></i>
                                <h5 class="text-muted"><?php echo e(__('general.no_attendance_yet')); ?></h5>
                                <p class="text-muted"><?php echo e(__('general.no_attendance_data_yet')); ?></p>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Top học viên -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-star mr-2"></i><?php echo e(__('general.top_5_excellent_students')); ?>

                        </h5>
                    </div>
                    <div class="card-body">
                        <!--[if BLOCK]><![endif]--><?php if($topStudents->count() > 0): ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $topStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $studentData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="mr-3">
                                        <!--[if BLOCK]><![endif]--><?php if($loop->index + 1 < 4): ?>
                                            <span class="badge bg-warning"><?php echo e($loop->index + 1); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo e($loop->index + 1); ?></span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-medium"><?php echo e($studentData['student']->name); ?></div>
                                        <small class="text-muted"><?php echo e($studentData['student']->email); ?></small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-success"><?php echo e($studentData['attendance_rate']); ?>%</div>
                                        <small
                                            class="text-muted"><?php echo e($studentData['present_days']); ?>/<?php echo e($studentData['total_days']); ?></small>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="bi bi-people fs-1 text-muted mb-2"></i>
                                <p class="text-muted mb-0"><?php echo e(__('general.no_student_data')); ?></p>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <!-- Nút hành động nhanh -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-lightning mr-2"></i><?php echo e(__('general.quick_actions')); ?>

                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('teacher.my-class.index')); ?>" class="btn btn-primary w-100">
                                    <i class="bi bi-calendar-check mr-2"></i><?php echo e(__('general.attendance_by_class')); ?>

                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('teacher.attendance.history')); ?>"
                                    class="btn btn-outline-primary w-100">
                                    <i class="bi bi-calendar-week mr-2"></i><?php echo e(__('general.attendance_history')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/attendance/overview.blade.php ENDPATH**/ ?>