<div>

<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'reports']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'reports']); ?>

    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-bar-chart mr-2"></i>
                Báo cáo học tập
            </h4>

        </div>

    </div>

    <!-- FILTER -->
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <label class="form-label">
                        Lọc theo lớp
                    </label>

                    <select
                        class="form-control"
                        wire:model.live="selectedClass"
                    >

                        <option value="">
                            Tất cả lớp
                        </option>

                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($classroom->id); ?>">
                                <?php echo e($classroom->name); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                    </select>

                </div>

                <div class="col-md-2">

                    <label class="form-label">
                        &nbsp;
                    </label>

                    <button
                        class="btn btn-outline-secondary w-100"
                        wire:click="resetFilters"
                    >

                        <i class="bi bi-arrow-clockwise mr-1"></i>

                        Đặt lại

                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Học viên</th>

                            <th>Lớp</th>

                            <th>Điểm trung bình</th>

                            <th>Xếp hạng</th>

                            <th>Tỷ lệ nộp bài</th>

                            <th>Số buổi tham gia</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                            $currentGrade = null;

                            $currentRank = 0;

                            $displayRank = 0;

                            $lastScore = null;
                        ?>

                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php

                                $classroomName =
                                    $student->classrooms
                                        ->first()?->name ?? '';

                                preg_match(
                                    '/\d+/',
                                    $classroomName,
                                    $matches
                                );

                                $studentGrade =
                                    $matches[0] ?? null;

                                /**
                                 * Reset rank khi sang khối mới
                                 */
                                if (
                                    $currentGrade !=
                                    $studentGrade
                                ) {

                                    $currentGrade =
                                        $studentGrade;

                                    $currentRank = 0;

                                    $displayRank = 0;

                                    $lastScore = null;
                                }

                                /**
                                 * Đồng điểm = cùng hạng
                                 */
                                if (
                                    $student->average_score > 0
                                ) {

                                    $currentRank++;

                                    if (
                                        $lastScore
                                        !==
                                        $student->average_score
                                    ) {

                                        $displayRank =
                                            $currentRank;

                                        $lastScore =
                                            $student->average_score;
                                    }

                                } else {

                                    $displayRank = null;
                                }

                            ?>

                            <tr>

                                <!-- TÊN -->
                                <td class="fw-semibold">
                                    <?php echo e($student->name); ?>

                                </td>

                                <!-- LỚP -->
                                <td>

                                    <!--[if BLOCK]><![endif]--><?php $__empty_2 = true; $__currentLoopData = $student->classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                                        <span class="badge bg-primary me-1">
                                            <?php echo e($classroom->name); ?>

                                        </span>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

                                        <span class="text-muted">
                                            Chưa có lớp
                                        </span>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                </td>

                                <!-- ĐIỂM TB -->
                                <td>

                                    <!--[if BLOCK]><![endif]--><?php if($student->average_score > 0): ?>

                                        <span class="fw-bold text-primary">
                                            <?php echo e(number_format($student->average_score, 1)); ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Chưa có điểm
                                        </span>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                </td>

                                <!-- XẾP HẠNG -->
                                <td>

                                    <!--[if BLOCK]><![endif]--><?php if($displayRank): ?>

                                        <span class="badge bg-warning text-dark">
                                            #<?php echo e($displayRank); ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Chưa có xếp hạng
                                        </span>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                </td>

                                <!-- TỶ LỆ NỘP BÀI -->
                                <td>

                                    <div class="fw-bold">
                                        <?php echo e($student->submit_rate); ?>%
                                    </div>

                                    <small class="text-muted">

                                        <?php echo e($student->graded_assignments); ?>

                                        /
                                        <?php echo e($student->assignments_checked); ?>

                                        bài

                                    </small>

                                </td>

                                <!-- SỐ BUỔI THAM GIA -->
                                <td>

                                     <div class="fw-bold text-info">

        <?php echo e($student->present_count); ?>

        /
        <?php echo e($student->total_attendance); ?>

        buổi

    </div>

    <small class="text-muted">

        <!--[if BLOCK]><![endif]--><?php if($student->total_attendance > 0): ?>

            <?php echo e(round(($student->present_count / $student->total_attendance) * 100)); ?>%

        <?php else: ?>

            0%

        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4 text-muted">

                                    Không có dữ liệu

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

</div><?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/reports/index.blade.php ENDPATH**/ ?>