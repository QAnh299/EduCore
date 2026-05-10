<?php if (isset($component)) { $__componentOriginal185e6e7d8721a01a42e994a332e9d66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal185e6e7d8721a01a42e994a332e9d66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-assistant','data' => ['active' => 'grade-entry','title' => 'Nhập điểm mới']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-assistant'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'grade-entry','title' => 'Nhập điểm mới']); ?>

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

            <!-- FILTER -->
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <div class="row g-3">

                        <!-- SEARCH -->
                        <div class="col-md-4">

                            <label for="search" class="form-label">
                                Tìm kiếm học viên
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="search"
                                wire:model.live="search"
                                placeholder="Nhập tên học viên..."
                            >

                        </div>

                        <!-- FILTER CLASS -->
                        <div class="col-md-3">

                            <label for="classroomFilter" class="form-label">
                                <?php echo e(__('general.classroom')); ?>

                            </label>

                            <select
                                class="form-control"
                                id="classroomFilter"
                                wire:model.live="classroomFilter"
                            >

                                <option value="">
                                    <?php echo e(__('general.all_classes')); ?>

                                </option>

                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value="<?php echo e($classroom->id); ?>">
                                        <?php echo e($classroom->name); ?>

                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                            </select>

                        </div>

                        <!-- CLEAR FILTER -->
                        <div class="col-md-2">

                            <label class="form-label">
                                &nbsp;
                            </label>

                            <button
                                class="btn btn-outline-secondary w-100"
                                wire:click="clearFilters"
                            >

                                <i class="bi bi-x-circle mr-2"></i>

                                <?php echo e(__('general.clear_filters')); ?>


                            </button>

                        </div>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="card card-outline card-primary">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th>Tên học viên</th>
                                        <th>Lớp học</th>
                                        <th>Điểm trung bình</th>
                                        <th>Xếp hạng</th>
                                        <th width="140">Thao tác</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        <?php
                                            $studentRank = $this->getStudentRank(
                                                $student->id,
                                            );
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

                                                <!--[if BLOCK]><![endif]--><?php if($student->average_score !== null): ?>

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

                                                <!--[if BLOCK]><![endif]--><?php if($studentRank): ?>

                                                    <span class="badge bg-warning text-dark">
                                                        #<?php echo e($studentRank); ?>

                                                    </span>

                                                <?php else: ?>

                                                    <span class="text-muted">
                                                        Chưa có xếp hạng
                                                    </span>

                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                            </td>

                                            <!-- ACTION -->
                                            <td>

                                                <a
                                                    href="<?php echo e(route('assistant.grade-entry-assistant.show', $student->id)); ?>"
                                                    class="btn btn-sm btn-info"
                                                >
                                                    Xem chi tiết
                                                </a>

                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                        <tr>

                                            <td colspan="5" class="text-center py-4">

                                                <div class="text-muted">
                                                    Không có dữ liệu
                                                </div>

                                            </td>

                                        </tr>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                </tbody>

                            </table>

                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            <?php echo e($students->links()); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal185e6e7d8721a01a42e994a332e9d66f)): ?>
<?php $attributes = $__attributesOriginal185e6e7d8721a01a42e994a332e9d66f; ?>
<?php unset($__attributesOriginal185e6e7d8721a01a42e994a332e9d66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal185e6e7d8721a01a42e994a332e9d66f)): ?>
<?php $component = $__componentOriginal185e6e7d8721a01a42e994a332e9d66f; ?>
<?php unset($__componentOriginal185e6e7d8721a01a42e994a332e9d66f); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\educore\resources\views/assistant/grade-entry/index.blade.php ENDPATH**/ ?>