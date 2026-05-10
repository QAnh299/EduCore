<?php if (isset($component)) { $__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-admin','data' => ['active' => 'classrooms','title' => '@lang(\'general.manage_classrooms\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'classrooms','title' => '@lang(\'general.manage_classrooms\')']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Flash Messages -->
    <!--[if BLOCK]><![endif]--><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fas fa-graduation-cap mr-2"></i><?php echo app('translator')->get('general.manage_classrooms'); ?>
                </h4>
                <a href="<?php echo e(route('classrooms.create') ?? '#'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i><?php echo app('translator')->get('general.add_classroom'); ?>
                </a>
            </div>

            <!-- Search Bar & Filters -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->get('general.search_and_filter'); ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input wire:model.live="search" type="text" class="form-control"
                                    placeholder="<?php echo app('translator')->get('general.search_classroom_placeholder'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select wire:model.live="filterTeacher" class="form-control">
                                <option value=""><?php echo app('translator')->get('general.all_teachers'); ?></option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value=""><?php echo app('translator')->get('general.all_status'); ?></option>
                                <option value="draft"><?php echo app('translator')->get('general.draft'); ?></option>
                                <option value="active"><?php echo app('translator')->get('general.active'); ?></option>
                                <option value="inactive"><?php echo app('translator')->get('general.inactive'); ?></option>
                                <option value="completed"><?php echo app('translator')->get('general.completed'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="showTrashed"
                                    id="showTrashed">
                                <label class="form-check-label" for="showTrashed">
                                    <?php echo app('translator')->get('general.show_trashed'); ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="hideCompleted"
                                    id="hideCompleted">
                                <label class="form-check-label" for="hideCompleted">
                                    <?php echo app('translator')->get('general.hide_completed_classes'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Classrooms Table -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->get('general.classroom_list'); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th><?php echo app('translator')->get('general.classroom_name'); ?></th>
                                    <th class="text-center" style="width: 150px;"><?php echo app('translator')->get('general.study_time'); ?></th>
                                    <th><?php echo app('translator')->get('general.teacher'); ?></th>
                                    <th class="text-center" style="width: 100px;"><?php echo app('translator')->get('general.student_count'); ?></th>
                                    <th class="text-center" style="width: 120px;"><?php echo app('translator')->get('general.status'); ?></th>
                                    <th class="text-center" style="width: 200px;"><?php echo app('translator')->get('general.actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($index + 1); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold"><?php echo e($classroom->name); ?></div>
                                                    <!--[if BLOCK]><![endif]--><?php if(isset($classroom->notes) && $classroom->notes): ?>
                                                        <small class="text-muted"><?php echo e($classroom->notes); ?></small>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <!--[if BLOCK]><![endif]--><?php if($classroom->schedule && isset($classroom->schedule['days']) && isset($classroom->schedule['time'])): ?>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="badge badge-info mb-1" style="font-size: 0.75rem;">
                                                        <i class="fas fa-calendar-alt mr-1"></i>
                                                        <?php echo e(implode(', ', \App\Helpers\DateHelper::translateDays($classroom->schedule['days']))); ?>

                                                    </div>
                                                    <div class="badge badge-success" style="font-size: 0.75rem;">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        <?php echo e($classroom->schedule['time']); ?>

                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 0.8rem;">
                                                    <i class="fas fa-calendar-times mr-1"></i>
                                                    <?php echo app('translator')->get('general.no_schedule'); ?>
                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($classroom->teachers->count()): ?>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classroom->users->whereIn('pivot.role', ['teacher', 'assistant']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="badge badge-secondary"><?php echo e($teacher->name); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php else: ?>
                                                <span class="text-muted"><?php echo app('translator')->get('general.no_teacher'); ?></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info"><?php echo e($classroom->students_count); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                $statusClass = match ($classroom->status) {
                                                    'draft' => 'light',
                                                    'active' => 'success',
                                                    'inactive' => 'secondary',
                                                    'completed' => 'warning',
                                                    default => 'secondary',
                                                };

                                                $statusText = match ($classroom->status) {
                                                    'draft' => __('general.draft'),
                                                    'active' => __('general.active'),
                                                    'inactive' => __('general.inactive'),
                                                    'completed' => __('general.completed'),
                                                    default => __('general.inactive'),
                                                };
                                            ?>
                                            <span class="badge badge-<?php echo e($statusClass); ?>">
                                                <?php echo e($statusText); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('classrooms.show', $classroom)); ?>"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    title="<?php echo app('translator')->get('general.view_details'); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('classrooms.attendance', $classroom)); ?>"
                                                    class="btn btn-sm btn-outline-info" title="<?php echo app('translator')->get('general.take_attendance'); ?>">
                                                    <i class="fas fa-calendar-check"></i>
                                                </a>
                                                <a href="<?php echo e(route('classrooms.attendance-history', $classroom)); ?>"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    title="<?php echo app('translator')->get('general.attendance_history'); ?>">
                                                    <i class="fas fa-calendar-week"></i>
                                                </a>
                                                <a href="<?php echo e(route('classrooms.assign-students', $classroom)); ?>"
                                                    class="btn btn-sm btn-outline-success" title="<?php echo app('translator')->get('general.assign_students'); ?>">
                                                    <i class="fas fa-user-plus"></i>
                                                </a>
                                                <a href="<?php echo e(route('classrooms.edit', $classroom)); ?>"
                                                    class="btn btn-sm btn-outline-primary" title="<?php echo app('translator')->get('general.edit'); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!--[if BLOCK]><![endif]--><?php if($showTrashed && !is_null($classroom->deleted_at)): ?>
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        wire:click="restore(<?php echo e($classroom->id); ?>)"
                                                        title="<?php echo app('translator')->get('general.restore_classroom'); ?>">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <!--[if BLOCK]><![endif]--><?php if($classroom->status === 'active'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                                            title="<?php echo app('translator')->get('general.cannot_delete_active_classroom'); ?>" disabled>
                                                            <i class="fas fa-lock"></i>
                                                        </button>
                                                    <?php elseif($classroom->students_count > 0): ?>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteModal<?php echo e($classroom->id); ?>"
                                                            class="btn btn-sm btn-outline-warning"
                                                            title="<?php echo app('translator')->get('general.hide_classroom_with_students'); ?>">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </button>
                                                    <?php elseif($classroom->status === 'draft' && $classroom->students_count == 0): ?>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteModal<?php echo e($classroom->id); ?>"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="<?php echo app('translator')->get('general.delete_draft_classroom'); ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php elseif($classroom->status === 'completed'): ?>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteModal<?php echo e($classroom->id); ?>"
                                                            class="btn btn-sm btn-outline-warning"
                                                            title="<?php echo app('translator')->get('general.hide_completed_classes'); ?>">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteModal<?php echo e($classroom->id); ?>"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="<?php echo app('translator')->get('general.delete'); ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo e($classroom->id); ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel<?php echo e($classroom->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="deleteModalLabel<?php echo e($classroom->id); ?>">
                                                        <?php if($classroom->status === 'draft' && $classroom->students_count == 0): ?>
                                                            <?php echo app('translator')->get('general.confirm_delete_draft_classroom'); ?>
                                                        <?php elseif($classroom->students_count > 0): ?>
                                                            <?php echo app('translator')->get('general.confirm_hide_classroom'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('general.confirm_delete_classroom'); ?>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php if($classroom->status === 'draft' && $classroom->students_count == 0): ?>
                                                        <?php echo app('translator')->get('general.delete_draft_classroom_message', ['name' => $classroom->name]); ?>
                                                    <?php elseif($classroom->students_count > 0): ?>
                                                        <?php echo app('translator')->get('general.hide_classroom_message', ['name' => $classroom->name]); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('general.delete_classroom_message', ['name' => $classroom->name]); ?>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal"><?php echo app('translator')->get('general.cancel'); ?></button>
                                                    <button type="button"
                                                        class="btn btn-<?php echo e(($classroom->status === 'draft' && $classroom->students_count == 0) || $classroom->students_count == 0 ? 'danger' : 'warning'); ?>"
                                                        id="confirmDelete<?php echo e($classroom->id); ?>"
                                                        wire:click="delete(<?php echo e($classroom->id); ?>)"
                                                        onclick="closeModal(<?php echo e($classroom->id); ?>)">
                                                        <?php if($classroom->status === 'draft' && $classroom->students_count == 0): ?>
                                                            <?php echo app('translator')->get('general.delete'); ?>
                                                        <?php elseif($classroom->students_count > 0): ?>
                                                            <?php echo app('translator')->get('general.hide'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('general.delete'); ?>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            <?php echo app('translator')->get('general.showing_results', [
                                'from' => $classrooms->firstItem() ?? 0,
                                'to' => $classrooms->lastItem() ?? 0,
                                'total' => $classrooms->total() ?? 0,
                            ]); ?>
                        </div>
                        <div>
                            <?php echo e($classrooms->links('vendor.pagination.bootstrap-5')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal(classroomId) {
            setTimeout(function() {
                $('#deleteModal' + classroomId).modal('hide');
            }, 100);
        }

        // Lắng nghe sự kiện refresh từ Livewire
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('refresh', () => {
                window.location.reload();
            });
        });
    </script>
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/admin/classrooms/index.blade.php ENDPATH**/ ?>