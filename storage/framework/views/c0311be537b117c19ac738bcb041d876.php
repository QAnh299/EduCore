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

        <!-- HEADER -->
        <div class="mb-4">

            <a
                href="<?php echo e(route('teacher.my-class.index')); ?>"
                class="text-decoration-none text-secondary d-inline-block mb-3"
            >
                <i class="bi bi-arrow-left mr-2"></i>
                Quay lại lớp học
            </a>

            <h4 class="mb-0 text-primary fs-4">

                <i class="bi bi-calendar-check mr-2"></i>

                Điểm danh - <?php echo e($classroom->name); ?>


            </h4>

        </div>

        <!-- THỐNG KÊ -->
        <div class="row mb-4">

            <div class="col-md-3">

                <div class="card bg-primary text-white">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="card-title mb-0">
                                    Tổng học sinh
                                </h6>

                                <h3 class="mb-0">
                                    <?php echo e($stats['total']); ?>

                                </h3>

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

                                <h6 class="card-title mb-0">
                                    Có mặt
                                </h6>

                                <h3 class="mb-0">
                                    <?php echo e($stats['present']); ?>

                                </h3>

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

                                <h6 class="card-title mb-0">
                                    Vắng
                                </h6>

                                <h3 class="mb-0">
                                    <?php echo e($stats['absent']); ?>

                                </h3>

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

                                <h6 class="card-title mb-0">
                                    Tỷ lệ tham gia
                                </h6>

                                <h3 class="mb-0">
                                    <?php echo e($stats['presentPercentage']); ?>%
                                </h3>

                            </div>

                            <div class="align-self-center">

                                <i class="bi bi-percent fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- CARD -->
        <div class="card shadow-sm">

            <div class="card-header bg-light">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h5 class="mb-0 text-primary">

                            <i class="bi bi-calendar-event mr-2"></i>

                            Điểm danh ngày
                            <?php echo e(now()->format('d/m/Y')); ?>


                            <small class="text-muted ml-2">
                                (<?php echo e(now()->format('H:i')); ?>)
                            </small>

                        </h5>

                    </div>

                    <div class="col-md-4 text-end">

                        <button
                            wire:click="saveAttendance"
                            class="btn btn-primary"
                            <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>

                        >

                            <i class="bi bi-save mr-2"></i>

                            Lưu điểm danh

                        </button>

                    </div>

                </div>

            </div>

            <div class="card-body">

                <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>

                    <div class="alert alert-success">

                        <?php echo e(session('message')); ?>


                    </div>

                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <?php if(session()->has('error')): ?>

                    <div class="alert alert-danger">

                        <?php echo e(session('error')); ?>


                    </div>

                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if(!$canTakeAttendance): ?>

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-triangle mr-2"></i>

                        <?php echo e($attendanceMessage); ?>


                    </div>

                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Học sinh</th>

                                <th>Trạng thái</th>

                                <th>Lý do nghỉ</th>

                                <th>Thao tác</th>

                            </tr>

                        </thead>

                        <tbody>

                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $attendanceData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>
                                        <?php echo e($index + 1); ?>

                                    </td>

                                    <td>

                                        <div class="fw-semibold">
                                            <?php echo e($data['student']->name); ?>

                                        </div>

                                        <small class="text-muted">
                                            <?php echo e($data['student']->email); ?>

                                        </small>

                                    </td>

                                    <td>

                                        <div class="form-check form-switch">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                wire:click="toggleAttendance(<?php echo e($data['student_record']->id); ?>)"
                                                <?php echo e($data['present'] ? 'checked' : ''); ?>

                                                <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>

                                            >

                                            <!--[if BLOCK]><![endif]--><?php if($data['present']): ?>

                                                <span class="badge bg-success">

                                                    <i class="bi bi-check-circle mr-1"></i>

                                                    Có mặt

                                                </span>

                                            <?php else: ?>

                                                <span class="badge bg-danger">

                                                    <i class="bi bi-x-circle mr-1"></i>

                                                    Vắng

                                                </span>

                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                        </div>

                                    </td>

                                    <td>

                                        <!--[if BLOCK]><![endif]--><?php if(!$data['present']): ?>

                                            <?php echo e($data['reason'] ?: 'Chưa có lý do'); ?>


                                        <?php else: ?>

                                            -

                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                    </td>

                                    <td>

                                        <!--[if BLOCK]><![endif]--><?php if(!$data['present']): ?>

                                            <button
                                                class="btn btn-sm btn-outline-primary"
                                                wire:click="openReasonModal(<?php echo e($data['student_record']->id); ?>)"
                                                <?php echo e(!$canTakeAttendance ? 'disabled' : ''); ?>

                                            >

                                                Lý do

                                            </button>

                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <!--[if BLOCK]><![endif]--><?php if($showReasonModal): ?>

        <div class="modal fade show d-block">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Nhập lý do nghỉ

                        </h5>

                    </div>

                    <div class="modal-body">

                        <textarea
                            wire:model="absenceReason"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                    <div class="modal-footer">

                        <button
                            class="btn btn-secondary"
                            wire:click="$set('showReasonModal', false)"
                        >
                            Hủy
                        </button>

                        <button
                            class="btn btn-primary"
                            wire:click="saveReason"
                        >
                            Lưu
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/attendance/take-attendance.blade.php ENDPATH**/ ?>