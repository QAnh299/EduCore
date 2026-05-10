<?php
    // Cấu hình menu mặc định cho giáo viên
    $teacherMenuItems = [
        [
            'key' => 'home',
            'label' => __('general.dashboard'),
            'route' => route('dashboard'),
            'icon' => 'bi bi-house',
            'visible' => true,
        ],
        [
            'key' => 'my-class',
            'label' => __('general.my_class'),
            'route' => route('teacher.my-class.index'),
            'icon' => 'bi bi-diagram-3',
            'visible' => true,
        ],
        [
            'key' => 'schedules',
            'label' => __('general.schedules'),
            'route' => route('teacher.schedules.index'),
            'icon' => 'bi bi-calendar3',
            'visible' => true,
        ],
        [
            'key' => 'attendances',
            'label' => __('general.attendance'),
            'route' => route('teacher.attendance.overview'),
            'icon' => 'bi bi-calendar-check',
            'visible' => true,
        ],
        [
            'key' => 'lessons',
            'label' => __('general.lessons'),
            'route' => route('teacher.lessons.index'),
            'icon' => 'bi bi-book',
            'visible' => true,
        ],
        [
            'key' => 'assignments',
            'label' => __('general.assignments'),
            'route' => route('teacher.assignments.index'),
            'icon' => 'bi bi-journal-text',
            'visible' => true,
        ],
        [
            'key' => 'quizzes',
            'label' => __('general.quizzes'),
            'route' => route('teacher.quizzes.index'),
            'icon' => 'bi bi-patch-question',
            'visible' => true,
        ],
        [
            'key' => 'grade-entry',
            'label' => 'Nhập điểm',
            'route' => route('teacher.grade-entry-teacher.index'),
            'icon' => 'fas fa-pen',
            'visible' => true,
        ],
        [
            'key' => 'notifications',
            'label' => __('general.notifications'),
            'route' => route('teacher.notifications.index'),
            'icon' => 'bi bi-bell',
            'visible' => true,
        ],
        [
            'key' => 'chat',
            'label' => __('general.chat'),
            'route' => route('teacher.chat.index'),
            'icon' => 'bi bi-chat-dots',
            'visible' => true,
        ],
        [
            'key' => 'reports',
            'label' => __('general.class_reports'),
            'route' => route('teacher.reports.index'),
            'icon' => 'bi bi-bar-chart',
            'visible' => true,
        ],
        [
            'key' => 'evaluations-report',
            'label' => __('general.evaluation_report'),
            'route' => route('teacher.evaluations.report'),
            'icon' => 'bi bi-star',
            'visible' => true,
        ],
    ];
?>


<?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => ['active' => $active ?? null,'menuItems' => $menuItems ?? $teacherMenuItems,'brandLogo' => asset('educore-logo.png'),'brandText' => __('general.app_name'),'brandUrl' => '/','darkMode' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($active ?? null),'menu-items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menuItems ?? $teacherMenuItems),'brand-logo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('educore-logo.png')),'brand-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('general.app_name')),'brand-url' => '/','dark-mode' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/sidebar-teacher-config.blade.php ENDPATH**/ ?>