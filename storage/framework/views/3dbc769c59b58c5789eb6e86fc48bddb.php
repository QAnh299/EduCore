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
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('teacher.my-class.index')); ?>" class="text-decoration-none">
                                <i class="bi bi-arrow-left mr-1"></i>
                                <?php echo e(__('general.my_class')); ?>

                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($classroom->name); ?></li>
                    </ol>
                </nav>
                <h2 class="mb-0">
                    <i class="bi bi-diagram-3-fill text-primary mr-2"></i>
                    <?php echo e($classroom->name); ?>

                </h2>
                <p class="text-muted mb-0"><?php echo e($classroom->description); ?></p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?php echo e(route('teacher.attendance.take', $classroom)); ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-calendar-check mr-1"></i>
                        <?php echo e(__('general.new_attendance')); ?>

                    </a>
                    <a href="<?php echo e(route('teacher.lessons.create', ['classroom_id' => $classroom->id])); ?>"
                        class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-plus-circle mr-1"></i>
                        <?php echo e(__('general.add_lesson')); ?>

                    </a>
                    <a href="<?php echo e(route('teacher.assignments.create', ['classroom_id' => $classroom->id])); ?>"
                        class="btn btn-outline-success btn-sm">
                        <i class="bi bi-plus-circle mr-1"></i>
                        <?php echo e(__('general.add_assignment')); ?>

                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill text-success" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1"><?php echo e($classroom->students->count()); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.students')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-book-fill text-info" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1"><?php echo e($classroom->lessons->count()); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.lessons_label')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-text text-warning" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1"><?php echo e($classroom->assignments->count()); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.assignments')); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check text-primary" style="font-size: 2rem;"></i>
                        <h4 class="mt-2 mb-1"><?php echo e($classroom->attendances->count()); ?></h4>
                        <p class="text-muted mb-0"><?php echo e(__('general.sessions')); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="classroomTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($activeTab === 'overview' ? 'active' : ''); ?>"
                            wire:click="setActiveTab('overview')" type="button">
                            <i class="bi bi-house mr-1"></i>
                            <?php echo e(__('general.overview')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($activeTab === 'students' ? 'active' : ''); ?>"
                            wire:click="setActiveTab('students')" type="button">
                            <i class="bi bi-people mr-1"></i>
                            <?php echo e(__('general.students')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($activeTab === 'lessons' ? 'active' : ''); ?>"
                            wire:click="setActiveTab('lessons')" type="button">
                            <i class="bi bi-book mr-1"></i>
                            <?php echo e(__('general.lessons_label')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($activeTab === 'assignments' ? 'active' : ''); ?>"
                            wire:click="setActiveTab('assignments')" type="button">
                            <i class="bi bi-journal-text mr-1"></i>
                            <?php echo e(__('general.assignments')); ?>

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo e($activeTab === 'attendance' ? 'active' : ''); ?>"
                            wire:click="setActiveTab('attendance')" type="button">
                            <i class="bi bi-calendar-check mr-1"></i>
                            <?php echo e(__('general.attendance')); ?>

                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- Overview Tab -->
                <!--[if BLOCK]><![endif]--><?php if($activeTab === 'overview'): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-info-circle mr-2"></i>
                                <?php echo e(__('general.classroom_details')); ?>

                            </h6>
                            <div class="mb-3">
                                <strong><?php echo e(__('general.classroom_name')); ?>:</strong> <?php echo e($classroom->name); ?>

                            </div>
                            <div class="mb-3">
                                <strong><?php echo e(__('general.description')); ?>:</strong> <?php echo e($classroom->description); ?>

                            </div>
                            <div class="mb-3">
                                <strong><?php echo e(__('general.created_date')); ?>:</strong> <?php echo e($classroom->created_at->format('d/m/Y H:i')); ?>

                            </div>
                            <div class="mb-3">
                                <strong><?php echo e(__('general.status')); ?>:</strong>
                                <span class="badge bg-success"><?php echo e(__('general.active')); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-graph-up mr-2"></i>
                                <?php echo e(__('general.quick_statistics')); ?>

                            </h6>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <h4 class="text-primary mb-1"><?php echo e($classroom->lessons->count()); ?></h4>
                                        <small class="text-muted"><?php echo e(__('general.lessons_label')); ?></small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <h4 class="text-success mb-1"><?php echo e($classroom->assignments->count()); ?></h4>
                                        <small class="text-muted"><?php echo e(__('general.assignments')); ?></small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <h4 class="text-info mb-1"><?php echo e($classroom->students->count()); ?></h4>
                                        <small class="text-muted"><?php echo e(__('general.students')); ?></small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <h4 class="text-warning mb-1"><?php echo e($classroom->attendances->count()); ?></h4>
                                        <small class="text-muted"><?php echo e(__('general.sessions')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Activities -->
                    <div class="mt-4">
                        <h6 class="text-info mb-3">
                            <i class="bi bi-clock-history mr-2"></i>
                            <?php echo e(__('general.recent_activities')); ?>

                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-warning mb-2"><?php echo e(__('general.latest_lessons')); ?></h6>
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classroom->lessons->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                    <p class="text-muted"><?php echo e(__('general.no_lessons_yet')); ?></p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-success mb-2"><?php echo e(__('general.recent_assignments')); ?></h6>
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classroom->assignments->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="card mb-2">
                                        <div class="card-body py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1"><?php echo e($assignment->title); ?></h6>
                                                    <small
                                                        class="text-muted"><?php echo e(Str::limit($assignment->description, 50)); ?></small>
                                                </div>
                                                <small
                                                    class="text-muted"><?php echo e($assignment->created_at->format('d/m/Y')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-muted"><?php echo e(__('general.no_assignments_yet')); ?></p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Students Tab -->
                <!--[if BLOCK]><![endif]--><?php if($activeTab === 'students'): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-info mb-0">
                            <i class="bi bi-people mr-2"></i>
                            <?php echo e(__('general.student_list')); ?> (<?php echo e($classroom->students->count()); ?>)
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo e(__('general.no')); ?></th>
                                    <th><?php echo e(__('general.full_name')); ?></th>
                                    <th><?php echo e(__('general.email')); ?></th>
                                    <th><?php echo e(__('general.joined_at')); ?></th>
                                    <th><?php echo e(__('general.status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classroom->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-2"
                                                    style="width: 32px; height: 32px; font-size: 14px;">
                                                    <?php echo e(strtoupper(substr($student->name, 0, 1))); ?>

                                                </div>
                                                <?php echo e($student->name); ?>

                                            </div>
                                        </td>
                                        <td><?php echo e($student->email); ?></td>
                                        <td><?php echo e($student->pivot->created_at->format('d/m/Y')); ?></td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($student->status === 'active'): ?>
                                                <span class="badge bg-success"><?php echo e(__('general.active')); ?></span>
                                            <?php elseif($student->status === 'paused'): ?>
                                                <span class="badge bg-warning"><?php echo e(__('general.paused')); ?></span>
                                            <?php elseif($student->status === 'dropped'): ?>
                                                <span class="badge bg-danger"><?php echo e(__('general.dropped')); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?php echo e(__('general.undefined')); ?></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                                            <p class="mt-2"><?php echo e(__('general.no_students_in_class')); ?></p>
                                        </td>
                                    </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Lessons Tab -->
                <!--[if BLOCK]><![endif]--><?php if($activeTab === 'lessons'): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-warning mb-0">
                            <i class="bi bi-book mr-2"></i>
                            <?php echo e(__('general.lesson_list')); ?> (<?php echo e($classroom->lessons->count()); ?>)
                        </h6>
                        <a href="<?php echo e(route('teacher.lessons.create', ['classroom_id' => $classroom->id])); ?>"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-plus-circle mr-1"></i>
                            <?php echo e(__('general.add_lesson')); ?>

                        </a>
                    </div>
                    <div class="row">
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classroom->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-header bg-warning text-white">
                                        <h6 class="mb-0"><?php echo e($lesson->title); ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small"><?php echo e(Str::limit($lesson->description, 100)); ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small
                                                class="text-muted"><?php echo e($lesson->created_at->format('d/m/Y')); ?></small>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?php echo e(route('teacher.lessons.show', $lesson->id)); ?>"
                                                    class="btn btn-outline-warning">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('teacher.lessons.edit', $lesson->id)); ?>"
                                                    class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="text-center py-4">
                                    <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2 text-muted"><?php echo e(__('general.no_lessons_yet')); ?></p>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Assignments Tab -->
                <!--[if BLOCK]><![endif]--><?php if($activeTab === 'assignments'): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-success mb-0">
                            <i class="bi bi-journal-text mr-2"></i>
                            <?php echo e(__('general.assignment_list')); ?> (<?php echo e($classroom->assignments->count()); ?>)
                        </h6>
                        <a href="<?php echo e(route('teacher.assignments.create', ['classroom_id' => $classroom->id])); ?>"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-plus-circle mr-1"></i>
                            <?php echo e(__('general.add_assignment')); ?>

                        </a>
                    </div>
                    <div class="row">
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classroom->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><?php echo e($assignment->title); ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small"><?php echo e(Str::limit($assignment->description, 100)); ?>

                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small
                                                class="text-muted"><?php echo e($assignment->created_at->format('d/m/Y')); ?></small>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?php echo e(route('teacher.assignments.show', $assignment->id)); ?>"
                                                    class="btn btn-outline-success">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('teacher.assignments.edit', $assignment->id)); ?>"
                                                    class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="text-center py-4">
                                    <i class="bi bi-journal-text text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2 text-muted"><?php echo e(__('general.no_assignments_yet')); ?></p>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Attendance Tab -->
                <!--[if BLOCK]><![endif]--><?php if($activeTab === 'attendance'): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-primary mb-0">
                            <i class="bi bi-calendar-check mr-2"></i>
                            <?php echo e(__('general.attendance_history')); ?>

                        </h6>
                        <a href="<?php echo e(route('teacher.attendance.take', $classroom)); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle mr-1"></i>
                            <?php echo e(__('general.new_attendance')); ?>

                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo e(__('general.date')); ?></th>
                                    <th><?php echo e(__('general.session_label')); ?></th>
                                    <th><?php echo e(__('general.student_count')); ?></th>
                                    <th><?php echo e(__('general.present')); ?></th>
                                    <th><?php echo e(__('general.absent')); ?></th>
                                    <th><?php echo e(__('general.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $attendanceSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($session['date']->format('d/m/Y')); ?></td>
                                        <td><?php echo e(__('general.session_label')); ?></td>
                                        <td><?php echo e($classroom->students->count()); ?></td>
                                        <td>
                                            <span class="badge bg-success"><?php echo e($session['present_count']); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger"><?php echo e($session['absent_count']); ?></span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('teacher.attendance.take', $classroom)); ?>?date=<?php echo e($session['date']->format('Y-m-d')); ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-calendar-check text-muted" style="font-size: 2rem;"></i>
                                            <p class="mt-2"><?php echo e(__('general.no_attendance_history_yet')); ?></p>
                                        </td>
                                    </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/my-class/show.blade.php ENDPATH**/ ?>