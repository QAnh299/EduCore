<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'grade-entry','title' => 'Chi tiết điểm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'grade-entry','title' => 'Chi tiết điểm']); ?>

<div class="container mt-4">

    <!-- Nút quay lại -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="<?php echo e(route('teacher.grade-entry-teacher.index')); ?>"
           class="btn btn-outline-secondary d-inline-flex align-items-center">
            ← Quay lại
        </a>

        <!-- Nút thêm điểm -->
        <a href="<?php echo e(route('teacher.grade-entry-teacher.create', $student->id)); ?>"
           class="btn btn-primary">
            + Thêm điểm
        </a>
    </div>

    <h4 class="mb-3">
        Điểm của học viên: <strong><?php echo e($student->name); ?></strong>
    </h4>

    <!-- Bộ lọc -->
    <div class="mb-3">
        <select class="form-control w-25" wire:model.live="filter">
            <option value="all">Tất cả</option>
            <option value="homework">Bài về nhà</option>
            <option value="minitest">Minitest</option>
            <option value="monthly">Kiểm tra cuối tháng</option>
        </select>
    </div>

    <!-- Bảng điểm -->
    <div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th style="width:120px;">Ngày</th>
                    <th style="width:130px;">Loại</th>
                    <th>Bài tập</th>
                    <th style="width:90px;">Điểm</th>
                    <th style="width:150px;">Giáo viên</th>
                    <th>Nhận xét</th>
                    <th style="width:140px;">Thao tác</th>
                </tr>
            </thead>

            <tbody class="text-center">
            <!--[if BLOCK]><![endif]--><?php if($this->gradesCount > 0): ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $this->grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <!-- Ngày -->
                        <td>
                            <?php echo e(optional($grade->graded_at)->format('d/m/Y')); ?>

                        </td>

                        <!-- Loại -->
                        <td>
                            <!--[if BLOCK]><![endif]--><?php switch($grade->grade_type):
                                case ('homework'): ?>
                                    <span class="badge bg-primary">BTVN</span>
                                    <?php break; ?>
                                <?php case ('minitest'): ?>
                                    <span class="badge bg-warning text-dark">Minitest</span>
                                    <?php break; ?>
                                <?php case ('monthly_exam'): ?>
                                    <span class="badge bg-success">Cuối tháng</span>
                                    <?php break; ?>
                            <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>

                        <!-- Bài tập -->
                        <td class="text-start">
                            <?php echo e($grade->assignment?->title ?? '-'); ?>

                        </td>

                        <!-- Điểm -->
                        <td>
                            <span class="fw-bold">
                                <?php echo e($grade->score); ?>

                            </span>
                        </td>

                        <!-- Giáo viên -->
                        <td>
                            <?php echo e($grade->teacher?->name ?? '-'); ?>

                        </td>

                        <!-- Nhận xét -->
                        <td class="text-start">
                            <?php echo e($grade->feedback ?? '-'); ?>

                        </td>

                        <!-- Thao tác -->
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?php echo e(route('teacher.grade-entry-teacher.edit', $grade->id)); ?>"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button wire:click="delete(<?php echo e($grade->id); ?>)" 
                                onclick="confirm('Bạn chắc chắn muốn xóa điểm này?') || event.stopImmediatePropagation()"
                                class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="py-4 text-muted">
                            Chưa có điểm nào
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php else: ?>
        <tr>
            <td colspan="7" class="text-center py-4 text-muted">
                <!--[if BLOCK]><![endif]--><?php if($filter === 'all'): ?>
                    Học viên chưa có điểm nào.
                <?php else: ?>
                    Không có điểm thuộc loại đã chọn.
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </td>
        </tr>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>

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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/grade-entry/show.blade.php ENDPATH**/ ?>