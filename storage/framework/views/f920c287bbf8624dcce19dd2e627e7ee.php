<?php if (isset($component)) { $__componentOriginal185e6e7d8721a01a42e994a332e9d66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal185e6e7d8721a01a42e994a332e9d66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-assistant','data' => ['active' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-assistant'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'home']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container py-4">
        <div class="row g-4 gy-5">
            <!-- Lớp học của tôi -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.my-class.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-diagram-3-fill" style="font-size:2.5rem; color:#0d6efd;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.my_class'); ?></div>
                </a>
            </div>
            <!-- Lịch giảng dạy -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.schedules.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-calendar3" style="font-size:2.5rem; color:#fd7e14;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.teaching_schedule'); ?></div>
                </a>
            </div>
            <!-- Điểm danh -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.attendance.overview')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-calendar-check" style="font-size:2.5rem; color:#6f42c1;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.attendance'); ?></div>
                </a>
            </div>
            <!-- Bài học -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.lessons.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-book" style="font-size:2.5rem; color:#20c997;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.lessons'); ?></div>
                </a>
            </div>
            <!-- Bài tập -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.assignments.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-journal-text" style="font-size:2.5rem; color:#ffc107;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.assignments'); ?></div>
                </a>
            </div>
            <!-- Kiểm tra & Quiz -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.quizzes.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-patch-question-fill" style="font-size:2.5rem; color:#fd5e53;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.quizzes'); ?></div>
                </a>
            </div>
            <!-- Chấm bài -->
            <div class="col-6 col-md-3 text-center">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-journal-check" style="font-size:2.5rem; color:#6f42c1;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.grading'); ?></div>
                </a>
            </div>
            <!-- Báo cáo lớp học -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.reports.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-bar-chart-fill" style="font-size:2.5rem; color:#28a745;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.class_reports'); ?></div>
                </a>
            </div>
            <!-- Thông báo -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.notifications.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2 position-relative d-inline-block">
                        <i class="bi bi-bell-fill" style="font-size:2.5rem; color:#f59e42;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size:0.8rem;">2</span>
                    </div>
                    <div><?php echo app('translator')->get('general.notifications'); ?></div>
                </a>
            </div>
            <!-- Tin nhắn -->
            <div class="col-6 col-md-3 text-center">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="mb-2 position-relative d-inline-block">
                        <i class="bi bi-chat-dots-fill" style="font-size:2.5rem; color:#30c495;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size:0.8rem;">2</span>
                    </div>
                    <div><?php echo app('translator')->get('general.chat'); ?></div>
                </a>
            </div>
            <!-- Báo cáo đánh giá SV -->
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('assistant.evaluations.report')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-star-fill" style="font-size:2.5rem; color:#e91e63;"></i>
                    </div>
                    <div><?php echo e(__('general.evaluation_report')); ?></div>
                </a>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/assistant/home.blade.php ENDPATH**/ ?>