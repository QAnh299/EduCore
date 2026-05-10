<?php if (isset($component)) { $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-student','data' => ['active' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-student'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'home']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container py-4">
        <div class="row g-5">
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.schedules')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-calendar3" style="font-size:2.5rem; color:#ffc107;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.schedules'); ?></div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.lessons.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-book" style="font-size:2.5rem; color:#0d6efd;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.lessons'); ?></div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.assignments.overview')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-journal-text" style="font-size:2.5rem; color:#fd7e14;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.assignments'); ?></div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.quizzes.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-clipboard-check-fill" style="font-size:2.5rem; color:#6f42c1;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.quizzes'); ?></div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.reports.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2">
                        <i class="bi bi-bar-chart-fill" style="font-size:2.5rem; color:#20c997;"></i>
                    </div>
                    <div><?php echo app('translator')->get('general.results'); ?></div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.notifications.index')); ?>" class="text-decoration-none text-dark">
                    <div class="position-relative d-inline-block">
                        <i class="bi bi-bell-fill" style="font-size:2.5rem; color:#fd5e53;"></i>
                        <!--[if BLOCK]><![endif]--><?php if($unreadNotification > 0): ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size:0.8rem;"><?php echo e($unreadNotification); ?></span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="mt-2"><?php echo app('translator')->get('general.notifications'); ?></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="<?php echo e(route('student.chat.index')); ?>" class="text-decoration-none text-dark">
                    <div class="mb-2 position-relative d-inline-block">
                        <i class="bi bi-chat-dots-fill" style="font-size:2.5rem; color:#3372a2;"></i>
                        <!--[if BLOCK]><![endif]--><?php if($unreadCount > 0): ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size:0.8rem;"><?php echo e($unreadCount); ?></span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div><?php echo app('translator')->get('general.chat'); ?></div>
                </a>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/student/home.blade.php ENDPATH**/ ?>