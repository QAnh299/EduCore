<?php if (isset($component)) { $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-student','data' => ['active' => 'grade','title' => 'Quản lý điểm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-student'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'grade','title' => 'Quản lý điểm']); ?>

    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="row">

        <div class="col-12">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">
                    <i class="fas fa-edit mr-2"></i>
                    Quản lý điểm
                </h4>

            </div>

            <!-- MAIN CARD -->
            <div class="card shadow-sm">

                <div class="card-body">

                    <!-- THỐNG KÊ -->
                    <div class="row mb-4">

                        <!-- ĐIỂM TRUNG BÌNH -->
                        <div class="col-md-6 mb-3">

                            <div class="card bg-info text-white shadow h-100">

                                <div class="card-body text-center">

                                    <h6 class="mb-2">
                                        Điểm trung bình
                                    </h6>

                                    <h2 class="fw-bold mb-0">

                                        <!--[if BLOCK]><![endif]--><?php if($average > 0): ?>

                                            <?php echo e(number_format($average, 1)); ?>


                                        <?php else: ?>

                                            0

                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <!-- XẾP HẠNG -->
                        <div class="col-md-6 mb-3">

                            <div class="card bg-success text-white shadow h-100">

                                <div class="card-body text-center">

                                    <h6 class="mb-2">
                                        Xếp hạng
                                    </h6>

                                    <h2 class="fw-bold mb-0">

                                        <!--[if BLOCK]><![endif]--><?php if($rank): ?>

                                            <?php echo e($rank); ?>/<?php echo e($totalStudents); ?>


                                        <?php else: ?>

                                            Chưa có

                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">

                        <table class="table table-hover align-middle text-center">

                            <thead class="table-light">

                                <tr>
                                    <th>Loại điểm</th>
                                    <th>Bài tập</th>
                                    <th>Số điểm</th>
                                    <th>Người chấm</th>
                                    <th>Ngày chấm</th>
                                    <th>Nhận xét</th>
                                </tr>

                            </thead>

                            <tbody>

                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <tr>

                                        <!-- LOẠI ĐIỂM -->
                                        <td>

                                            <!--[if BLOCK]><![endif]--><?php switch($grade->grade_type):

                                                case ('homework'): ?>

                                                    <span class="badge bg-primary">
                                                        Homework
                                                    </span>

                                                    <?php break; ?>

                                                <?php case ('minitest'): ?>

                                                    <span class="badge bg-warning text-dark">
                                                        Minitest
                                                    </span>

                                                    <?php break; ?>

                                                <?php case ('monthly_exam'): ?>

                                                    <span class="badge bg-success">
                                                        Monthly Exam
                                                    </span>

                                                    <?php break; ?>

                                                <?php default: ?>

                                                    <span class="badge bg-secondary">
                                                        <?php echo e(ucfirst($grade->grade_type)); ?>

                                                    </span>

                                            <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->

                                        </td>

                                        <!-- BÀI TẬP -->
                                        <td>
                                            <?php echo e($grade->assignment->title ?? '-'); ?>

                                        </td>

                                        <!-- ĐIỂM -->
                                        <td>

                                            <span class="badge bg-success">

                                                <?php echo e(number_format($grade->score, 1)); ?>


                                            </span>

                                        </td>

                                        <!-- NGƯỜI CHẤM -->
                                        <td>
                                            <?php echo e($grade->teacher->name ?? '-'); ?>

                                        </td>

                                        <!-- NGÀY -->
                                        <td>

                                            <?php echo e(\Carbon\Carbon::parse($grade->graded_at)->format('d/m/Y')); ?>


                                        </td>

                                        <!-- NHẬN XÉT -->
                                        <td>

                                            <?php echo e($grade->feedback ?? '-'); ?>


                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                    <tr>

                                        <td colspan="6" class="text-center py-4 text-muted">

                                            <i class="fas fa-database mr-2"></i>

                                            Chưa có dữ liệu

                                        </td>

                                    </tr>

                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab)): ?>
<?php $attributes = $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab; ?>
<?php unset($__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269d5864c76e2ab5ce407a5373eff4ab)): ?>
<?php $component = $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab; ?>
<?php unset($__componentOriginal269d5864c76e2ab5ce407a5373eff4ab); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\educore\resources\views/student/grade/index.blade.php ENDPATH**/ ?>