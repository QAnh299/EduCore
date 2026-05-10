<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'my-class']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'my-class']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4 class="mb-0 fs-4 text-primary">
                    <i class="bi bi-diagram-3-fill text-primary mr-2"></i>
                    <?php echo e(__('general.my_class')); ?>

                </h4>
                <p class="text-muted mb-0"><?php echo e(__('general.manage_your_teaching_classes')); ?></p>
            </div>
            <div class="col-md-6 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <div class="input-group" style="max-width: 300px;">
                        <!--
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="<?php echo e(__('general.search_classes_placeholder')); ?>">
-->
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-diagram-3-fill text-primary" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1"><?php echo e($classrooms->total()); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.total_classes')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill text-success" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1">
                            <?php echo e($classrooms->sum(function ($classroom) {return $classroom->students->count();})); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.total_students')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-book text-info" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1">
                            <?php echo e($classrooms->sum(function ($classroom) {return $classroom->lessons->count();})); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.total_lessons')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-text text-warning" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1">
                            <?php echo e($classrooms->sum(function ($classroom) {return $classroom->assignments->count();})); ?>

                        </h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.total_assignments')); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classrooms List -->
        <div class="row">
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><?php echo e($classroom->name); ?></h6>
                                <span class="badge bg-light text-dark"><?php echo e($classroom->students->count()); ?> <?php echo e(__('general.students_short')); ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3"><?php echo e(Str::limit($classroom->description, 100)); ?></p>

                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <div class="border-end">
                                        <h6 class="mb-1 text-primary"><?php echo e($classroom->lessons->count()); ?></h6>
                                        <small class="text-muted"><?php echo e(__('general.lessons_label')); ?></small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-end">
                                        <h6 class="mb-1 text-success"><?php echo e($classroom->assignments->count()); ?></h6>
                                        <small class="text-muted"><?php echo e(__('general.assignments')); ?></small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <h6 class="mb-1 text-info"><?php echo e($classroom->students->count()); ?></h6>
                                    <small class="text-muted"><?php echo e(__('general.students')); ?></small>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="<?php echo e(route('teacher.my-class.show', $classroom->id)); ?>"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye mr-1"></i>
                                    <?php echo e(__('general.view_details')); ?>

                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="bi bi-calendar mr-1"></i>
                                <?php echo e(__('general.created_date')); ?>: <?php echo e($classroom->created_at->format('d/m/Y')); ?>

                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-diagram-3 text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted"><?php echo e(__('general.no_classes_found')); ?></h5>
                        <p class="text-muted"><?php echo e(__('general.no_classes_assigned')); ?></p>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!-- Pagination -->
        <!--[if BLOCK]><![endif]--><?php if($classrooms->hasPages()): ?>
            <div>
                <?php echo e($classrooms->links()); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Classroom Details Modal -->
    <!--[if BLOCK]><![endif]--><?php if($showClassroomDetails && $selectedClassroom): ?>
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-diagram-3-fill mr-2"></i>
                            <?php echo e($selectedClassroom->name); ?>

                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            wire:click="closeClassroomDetails"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-info-circle mr-2"></i>
                                    Thông tin lớp học
                                </h6>
                                <p><strong>Mô tả:</strong> <?php echo e($selectedClassroom->description); ?></p>
                                <p><strong>Ngày tạo:</strong> <?php echo e($selectedClassroom->created_at->format('d/m/Y H:i')); ?>

                                </p>
                                <p><strong>Số học sinh:</strong> <?php echo e($selectedClassroom->students->count()); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-success mb-3">
                                    <i class="bi bi-graph-up mr-2"></i>
                                    Thống kê
                                </h6>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border rounded p-3">
                                            <h4 class="text-primary mb-1"><?php echo e($selectedClassroom->lessons->count()); ?>

                                            </h4>
                                            <small class="text-muted">Bài học</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="border rounded p-3">
                                            <h4 class="text-success mb-1">
                                                <?php echo e($selectedClassroom->assignments->count()); ?></h4>
                                            <small class="text-muted">Bài tập</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Students List -->
                        <div class="mt-4">
                            <h6 class="text-info mb-3">
                                <i class="bi bi-people mr-2"></i>
                                Danh sách học sinh (<?php echo e($selectedClassroom->students->count()); ?>)
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Ngày tham gia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $selectedClassroom->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($student->name); ?></td>
                                                <td><?php echo e($student->email); ?></td>
                                                <td><?php echo e($student->pivot->created_at->format('d/m/Y')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Chưa có học sinh nào
                                                </td>
                                            </tr>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Recent Lessons -->
                        <div class="mt-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-book mr-2"></i>
                                Bài học gần đây
                            </h6>
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $selectedClassroom->lessons->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="card mb-2">
                                    <div class="card-body py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1"><?php echo e($lesson->title); ?></h6>
                                                <small
                                                    class="text-muted"><?php echo e(Str::limit($lesson->description, 50)); ?></small>
                                            </div>
                                            <small
                                                class="text-muted"><?php echo e($lesson->created_at->format('d/m/Y')); ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted text-center">Chưa có bài học nào</p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="closeClassroomDetails">Đóng</button>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-pencil mr-1"></i>
                            Chỉnh sửa lớp học
                        </a>
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/my-class/index.blade.php ENDPATH**/ ?>