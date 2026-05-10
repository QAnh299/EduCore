<?php if (isset($component)) { $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-student','data' => ['active' => 'notifications']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-student'); ?>
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
                        <i class="bi bi-bell mr-2"></i>Thông báo & Nhắc lịch
                    </h4>
                    <p class="text-muted mb-0">Xem các thông báo và nhắc nhở từ giáo viên</p>
                </div>
                <div class="d-flex gap-2">
                    <!--[if BLOCK]><![endif]--><?php if($this->unreadCount > 0): ?>
                        <button wire:click="markAllAsRead" class="btn btn-outline-primary">
                            <i class="bi bi-check-all mr-2"></i>Đánh dấu tất cả đã đọc
                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="position-relative">
                        <i class="bi bi-bell fs-4 text-primary"></i>
                        <!--[if BLOCK]><![endif]--><?php if($this->unreadCount > 0): ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo e($this->unreadCount > 99 ? '99+' : $this->unreadCount); ?>

                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tìm kiếm</label>
                        <input wire:model.live="search" type="text" class="form-control"
                            placeholder="Tìm theo tiêu đề hoặc nội dung...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Loại thông báo</label>
                        <select wire:model.live="filterType" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="info">Thông tin</option>
                            <option value="warning">Cảnh báo</option>
                            <option value="success">Thành công</option>
                            <option value="danger">Nguy hiểm</option>
                            <option value="reminder">Nhắc nhở</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select wire:model.live="filterStatus" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="unread">Chưa đọc</option>
                            <option value="read">Đã đọc</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button wire:click="resetFilters" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise mr-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="bi bi-list-ul mr-2"></i>Danh sách thông báo
                </h6>
            </div>
            <div class="card-body">
                <!--[if BLOCK]><![endif]--><?php if($notifications->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Thông báo</th>
                                    <th>Loại</th>
                                    <th>Lớp học</th>
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php echo e($notification->is_read ? '' : 'table-warning'); ?>">
                                        <td>
                                            <div class="d-flex align-items-start">
                                                <?php
                                                    $typeColors = [
                                                        'info' => 'primary',
                                                        'warning' => 'warning',
                                                        'success' => 'success',
                                                        'danger' => 'danger',
                                                        'reminder' => 'info',
                                                    ];
                                                    $typeIcons = [
                                                        'info' => 'bi-info-circle',
                                                        'warning' => 'bi-exclamation-triangle',
                                                        'success' => 'bi-check-circle',
                                                        'danger' => 'bi-x-circle',
                                                        'reminder' => 'bi-clock',
                                                    ];
                                                ?>
                                                <i
                                                    class="bi <?php echo e($typeIcons[$notification->type]); ?> text-<?php echo e($typeColors[$notification->type]); ?> mr-2 mt-1"></i>
                                                <div>
                                                    <div class="fw-medium <?php echo e($notification->is_read ? '' : 'fw-bold'); ?>"
                                                        style="cursor: pointer;"
                                                        wire:click="showNotification(<?php echo e($notification->id); ?>)">
                                                        <?php echo e($notification->title); ?>

                                                    </div>
                                                    <small
                                                        class="text-muted"><?php echo e(Str::limit($notification->message, 100)); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $typeLabels = [
                                                    'info' => 'Thông tin',
                                                    'warning' => 'Cảnh báo',
                                                    'success' => 'Thành công',
                                                    'danger' => 'Nguy hiểm',
                                                    'reminder' => 'Nhắc nhở',
                                                ];
                                            ?>
                                            <span class="badge bg-<?php echo e($typeColors[$notification->type]); ?>">
                                                <?php echo e($typeLabels[$notification->type]); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($notification->classroom): ?>
                                                <span class="badge bg-secondary">
                                                    <i
                                                        class="bi bi-diagram-3 mr-1"></i><?php echo e($notification->classroom?->name ?? 'N/A'); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <div>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock mr-1"></i>
                                                    <?php echo e($notification->created_at->diffForHumans()); ?>

                                                </small>
                                                <!--[if BLOCK]><![endif]--><?php if($notification->scheduled_at): ?>
                                                    <br>
                                                    <small class="text-info">
                                                        <i class="bi bi-calendar-event mr-1"></i>
                                                        Lịch: <?php echo e($notification->scheduled_at->format('d/m/Y H:i')); ?>

                                                    </small>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </td>

                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($notification->is_read): ?>
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check mr-1"></i>Đã đọc
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-exclamation mr-1"></i>Mới
                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if(!$notification->is_read): ?>
                                                <button wire:click="markAsRead(<?php echo e($notification->id); ?>)"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-check mr-1"></i>Đánh dấu đã đọc
                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div>
                        <?php echo e($notifications->links('vendor.pagination.bootstrap-5')); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash fs-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Không có thông báo nào</h5>
                        <p class="text-muted">Bạn sẽ thấy thông báo mới ở đây khi giáo viên gửi</p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
            <div class="toast show" role="alert">
                <div class="toast-header">
                    <i class="bi bi-check-circle text-success mr-2"></i>
                    <strong class="mr-auto">Thành công</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    <?php echo e(session('message')); ?>

                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Modal Chi tiết thông báo -->
    <!--[if BLOCK]><![endif]--><?php if($selectedNotification): ?>
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-labelledby="notificationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex align-items-center">
                            <?php
                                $typeColors = [
                                    'info' => 'primary',
                                    'warning' => 'warning',
                                    'success' => 'success',
                                    'danger' => 'danger',
                                    'reminder' => 'info',
                                ];
                                $typeIcons = [
                                    'info' => 'bi-info-circle',
                                    'warning' => 'bi-exclamation-triangle',
                                    'success' => 'bi-check-circle',
                                    'danger' => 'bi-x-circle',
                                    'reminder' => 'bi-clock',
                                ];
                            ?>
                            <i
                                class="bi <?php echo e($typeIcons[$selectedNotification->type]); ?> text-<?php echo e($typeColors[$selectedNotification->type]); ?> mr-2"></i>
                            <h5 class="modal-title" id="notificationModalLabel"><?php echo e($selectedNotification->title); ?>

                            </h5>
                        </div>
                        <button type="button" class="btn-close" wire:click="closeNotification"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>Nội dung:</strong>
                            <div class="mt-2 p-3 bg-light rounded">
                                <?php echo e($selectedNotification->message); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Loại thông báo:</strong>
                                <?php
                                    $typeLabels = [
                                        'info' => 'Thông tin',
                                        'warning' => 'Cảnh báo',
                                        'success' => 'Thành công',
                                        'danger' => 'Nguy hiểm',
                                        'reminder' => 'Nhắc nhở',
                                    ];
                                ?>
                                <span class="badge bg-<?php echo e($typeColors[$selectedNotification->type]); ?> ml-2">
                                    <?php echo e($typeLabels[$selectedNotification->type]); ?>

                                </span>
                            </div>
                            <div class="col-md-6">
                                <strong>Trạng thái:</strong>
                                <!--[if BLOCK]><![endif]--><?php if($selectedNotification->is_read): ?>
                                    <span class="badge bg-success ml-2">
                                        <i class="bi bi-check mr-1"></i>Đã đọc
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark ml-2">
                                        <i class="bi bi-exclamation mr-1"></i>Mới
                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($selectedNotification->classroom): ?>
                            <div class="mt-3">
                                <strong>Lớp học:</strong>
                                <span class="badge bg-secondary ml-2">
                                    <i
                                        class="bi bi-diagram-3 mr-1"></i><?php echo e($selectedNotification->classroom?->name ?? 'N/A'); ?>

                                </span>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <strong>Thời gian tạo:</strong>
                                <div class="text-muted"><?php echo e($selectedNotification->created_at->format('d/m/Y H:i:s')); ?>

                                </div>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if($selectedNotification->scheduled_at): ?>
                                <div class="col-md-6">
                                    <strong>Lịch gửi:</strong>
                                    <div class="text-muted">
                                        <?php echo e($selectedNotification->scheduled_at->format('d/m/Y H:i:s')); ?></div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($selectedNotification->expires_at): ?>
                            <div class="mt-3">
                                <strong>Hạn xem:</strong>
                                <div class="text-muted"><?php echo e($selectedNotification->expires_at->format('d/m/Y H:i:s')); ?>

                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="modal-footer">
                        <!--[if BLOCK]><![endif]--><?php if(!$selectedNotification->is_read): ?>
                            <button type="button" class="btn btn-success"
                                wire:click="markAsRead(<?php echo e($selectedNotification->id); ?>)">
                                <i class="bi bi-check mr-1"></i>Đánh dấu đã đọc
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <button type="button" class="btn btn-secondary" wire:click="closeNotification">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab)): ?>
<?php $attributes = $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab; ?>
<?php unset($__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269d5864c76e2ab5ce407a5373eff4ab)): ?>
<?php $component = $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab; ?>
<?php unset($__componentOriginal269d5864c76e2ab5ce407a5373eff4ab); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/student/notifications/index.blade.php ENDPATH**/ ?>