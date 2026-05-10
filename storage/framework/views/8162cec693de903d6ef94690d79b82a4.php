<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'notifications']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'notifications']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 text-primary fs-4">
                        <i class="bi bi-bell mr-2"></i><?php echo e(__('general.notifications_and_reminders')); ?>

                    </h4>
                    <p class="text-muted mb-0"><?php echo e(__('general.create_and_manage_notifications')); ?></p>
                </div>
                <div class="d-flex">
                    <button wire:click="markAllAsRead" class="btn btn-outline-secondary mr-2">
                        <i class="bi bi-check-all mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.mark_all_as_read')); ?></span>
                    </button>
                    <button wire:click="deleteExpired" class="btn btn-outline-warning mr-2">
                        <i class="bi bi-trash mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.delete_expired')); ?></span>
                    </button>
                    <button wire:click="create" class="btn btn-primary">
                        <i class="bi bi-plus-circle mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.create_new_notification')); ?></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label"><?php echo e(__('general.search')); ?></label>
                        <input wire:model.live="search" type="text" class="form-control"
                            placeholder="<?php echo e(__('general.search_by_title_content')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo e(__('general.notification_type')); ?></label>
                        <select wire:model.live="filterType" class="form-control">
                            <option value=""><?php echo e(__('general.all')); ?></option>
                            <option value="info"><?php echo e(__('general.info')); ?></option>
                            <option value="warning"><?php echo e(__('general.warning')); ?></option>
                            <option value="success"><?php echo e(__('general.success')); ?></option>
                            <option value="danger"><?php echo e(__('general.danger')); ?></option>
                            <option value="reminder"><?php echo e(__('general.reminder')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo e(__('general.status')); ?></label>
                        <select wire:model.live="filterStatus" class="form-control">
                            <option value=""><?php echo e(__('general.all')); ?></option>
                            <option value="unread"><?php echo e(__('general.unread')); ?></option>
                            <option value="read"><?php echo e(__('general.read')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button wire:click="$set('search', '')" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise mr-1"></i><span class="d-none d-md-inline"><?php echo e(__('general.reset')); ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <!--[if BLOCK]><![endif]--><?php if($notifications->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo e(__('general.title')); ?></th>
                                    <th><?php echo e(__('general.type')); ?></th>
                                    <th><?php echo e(__('general.classroom')); ?></th>
                                    <th><?php echo e(__('general.schedule')); ?></th>
                                    <th><?php echo e(__('general.status')); ?></th>
                                    <th><?php echo e(__('general.created_date')); ?></th>
                                    <th><?php echo e(__('general.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr
                                        class="<?php echo e($notification->scheduled_at && $notification->scheduled_at->isPast() ? 'table-warning' : ''); ?>">
                                        <td>
                                            <div class="fw-bold"><?php echo e($notification->title); ?></div>
                                            <small
                                                class="text-muted"><?php echo e(Str::limit($notification->message, 50)); ?></small>
                                        </td>
                                        <td>
                                            <?php
                                                $typeColors = [
                                                    'info' => 'primary',
                                                    'warning' => 'warning',
                                                    'success' => 'success',
                                                    'danger' => 'danger',
                                                    'reminder' => 'info',
                                                ];
                                                $typeLabels = [
                                                    'info' => __('general.info'),
                                                    'warning' => __('general.warning'),
                                                    'success' => __('general.success'),
                                                    'danger' => __('general.danger'),
                                                    'reminder' => __('general.reminder'),
                                                ];
                                            ?>
                                            <span class="badge bg-<?php echo e($typeColors[$notification->type]); ?>">
                                                <?php echo e($typeLabels[$notification->type]); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($notification->classroom): ?>
                                                <span
                                                    class="badge bg-secondary"><?php echo e($notification->classroom?->name ?? 'N/A'); ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($notification->scheduled_at): ?>
                                                <div><?php echo e($notification->scheduled_at->format('d/m/Y H:i')); ?></div>
                                                <!--[if BLOCK]><![endif]--><?php if($notification->scheduled_at->isPast()): ?>
                                                    <small class="text-warning fw-bold"><?php echo e(__('general.sent')); ?></small>
                                                <?php else: ?>
                                                    <small class="text-muted"><?php echo e(__('general.pending')); ?></small>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php else: ?>
                                                <span class="text-success fw-bold"><?php echo e(__('general.sent')); ?></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($notification->is_read): ?>
                                                <span class="badge bg-success"><?php echo e(__('general.read')); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-warning"><?php echo e(__('general.unread')); ?></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <div><?php echo e($notification->created_at->format('d/m/Y')); ?></div>
                                            <small
                                                class="text-muted"><?php echo e($notification->created_at->format('H:i')); ?></small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--[if BLOCK]><![endif]--><?php if(!$notification->is_read): ?>
                                                    <button wire:click="toggleRead(<?php echo e($notification->id); ?>)"
                                                        class="btn btn-sm btn-outline-success" title="<?php echo e(__('general.mark_as_read')); ?>">
                                                        <i class="bi bi-check"></i>
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <button wire:click="edit(<?php echo e($notification->id); ?>)"
                                                    class="btn btn-sm btn-outline-primary" title="<?php echo e(__('general.edit')); ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button wire:click="duplicate(<?php echo e($notification->id); ?>)"
                                                    class="btn btn-sm btn-outline-info" title="<?php echo e(__('general.duplicate')); ?>">
                                                    <i class="bi bi-files"></i>
                                                </button>
                                                <!--[if BLOCK]><![endif]--><?php if($notification->scheduled_at && $notification->scheduled_at->isFuture()): ?>
                                                    <button wire:click="sendNow(<?php echo e($notification->id); ?>)"
                                                        class="btn btn-sm btn-outline-success" title="<?php echo e(__('general.send_now')); ?>">
                                                        <i class="bi bi-send"></i>
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <button wire:click="delete(<?php echo e($notification->id); ?>)"
                                                    class="btn btn-sm btn-outline-danger" title="<?php echo e(__('general.delete')); ?>"
                                                    wire:confirm="<?php echo e(__('general.confirm_delete_notification')); ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?php echo e($notifications->links('vendor.pagination.bootstrap-5')); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash" style="font-size: 3rem; color: #ccc;"></i>
                        <h5 class="mt-3 text-muted"><?php echo e(__('general.no_notifications')); ?></h5>
                        <p class="text-muted"><?php echo e(__('general.create_first_notification')); ?></p>
                        <button wire:click="create" class="btn btn-primary">
                            <i class="bi bi-plus-circle mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.create_new_notification')); ?></span>
                        </button>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <!--[if BLOCK]><![endif]--><?php if($showCreateModal): ?>
        <div class="modal fade show" wire:ignore.self id="createModal" tabindex="-1"
            style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('general.create_new_notification')); ?></h5>
                        <button type="button" class="btn-close"
                            wire:click="$set('showCreateModal', false)"></button>
                    </div>
                    <form wire:submit="store">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label"><?php echo e(__('general.title')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="title" placeholder="<?php echo e(__('general.enter_notification_title')); ?>">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['title'];
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
                                <div class="col-12">
                                    <label class="form-label"><?php echo e(__('general.content')); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="message" rows="4"
                                        placeholder="<?php echo e(__('general.enter_notification_content')); ?>"></textarea>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['message'];
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
                                    <label class="form-label"><?php echo e(__('general.notification_type')); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="type">
                                        <option value="info"><?php echo e(__('general.info')); ?></option>
                                        <option value="warning"><?php echo e(__('general.warning')); ?></option>
                                        <option value="success"><?php echo e(__('general.success')); ?></option>
                                        <option value="danger"><?php echo e(__('general.danger')); ?></option>
                                        <option value="reminder"><?php echo e(__('general.reminder')); ?></option>
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['type'];
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
                                    <label class="form-label"><?php echo e(__('general.classroom')); ?></label>
                                    <select class="form-control <?php $__errorArgs = ['class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="class_id">
                                        <option value=""><?php echo e(__('general.all_classrooms')); ?></option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($classroom->id); ?>"><?php echo e($classroom->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['class_id'];
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
                                    <label class="form-label"><?php echo e(__('general.schedule')); ?></label>
                                    <input type="datetime-local"
                                        class="form-control <?php $__errorArgs = ['scheduled_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="scheduled_at">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['scheduled_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    <small class="form-text text-muted"><?php echo e(__('general.leave_empty_send_now')); ?></small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" wire:model="is_urgent"
                                            id="is_urgent">
                                        <label class="form-check-label" for="is_urgent">
                                            <?php echo e(__('general.urgent_notification')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                wire:click="$set('showCreateModal', false)"><?php echo e(__('general.cancel')); ?></button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.create_notification')); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Edit Modal -->
    <!--[if BLOCK]><![endif]--><?php if($showEditModal): ?>
        <div class="modal fade show" wire:ignore.self id="editModal" tabindex="-1"
            style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('general.edit_notification')); ?></h5>
                        <button type="button" class="btn-close" wire:click="$set('showEditModal', false)"></button>
                    </div>
                    <form wire:submit="update">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label"><?php echo e(__('general.title')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="title" placeholder="<?php echo e(__('general.enter_notification_title')); ?>">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['title'];
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
                                <div class="col-12">
                                    <label class="form-label"><?php echo e(__('general.content')); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="message" rows="4"
                                        placeholder="<?php echo e(__('general.enter_notification_content')); ?>"></textarea>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['message'];
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
                                    <label class="form-label"><?php echo e(__('general.notification_type')); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="type">
                                        <option value="info"><?php echo e(__('general.info')); ?></option>
                                        <option value="warning"><?php echo e(__('general.warning')); ?></option>
                                        <option value="success"><?php echo e(__('general.success')); ?></option>
                                        <option value="danger"><?php echo e(__('general.danger')); ?></option>
                                        <option value="reminder"><?php echo e(__('general.reminder')); ?></option>
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['type'];
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
                                    <label class="form-label"><?php echo e(__('general.classroom')); ?></label>
                                    <select class="form-control <?php $__errorArgs = ['class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="class_id">
                                        <option value=""><?php echo e(__('general.all_classrooms')); ?></option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($classroom->id); ?>"><?php echo e($classroom->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['class_id'];
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
                                    <label class="form-label"><?php echo e(__('general.schedule')); ?></label>
                                    <input type="datetime-local"
                                        class="form-control <?php $__errorArgs = ['scheduled_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        wire:model="scheduled_at">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['scheduled_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    <small class="form-text text-muted"><?php echo e(__('general.leave_empty_send_now')); ?></small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" wire:model="is_urgent"
                                            id="is_urgent_edit">
                                        <label class="form-check-label" for="is_urgent_edit">
                                            <?php echo e(__('general.urgent_notification')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                wire:click="$set('showEditModal', false)"><?php echo e(__('general.cancel')); ?></button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle mr-2"></i><span class="d-none d-md-inline"><?php echo e(__('general.update_notification')); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <style>
        /* Modal scrollable cho Bootstrap 4 */
        .modal-dialog {
            max-height: 90vh;
        }
        
        .modal-content {
            max-height: 90vh;
        }
        
        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/notifications/index.blade.php ENDPATH**/ ?>