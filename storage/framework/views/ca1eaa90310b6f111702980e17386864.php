<?php
    // Cấu hình menu mặc định cho hệ thống EduCore
    $role = auth()->user()->role;

    // helper tránh lỗi route
    function safeRoute($condition, $routeName) {
        return $condition && Route::has($routeName) ? route($routeName) : '#';
    }

    $defaultMenuItems = [
        [
            'key' => 'home',
            'label' => __('general.dashboard'),
            'route' => route('dashboard'),
            'icon' => 'fas fa-home',
            //'visible' => true,
            'visible' => $role === 'boss',
        ],

        // ===== ADMIN =====
        [
            'key' => 'users',
            'label' => __('general.manage_users'),
            'route' => safeRoute($role === 'admin', 'users.index'),
            'icon' => 'fas fa-users-cog',
            'visible' => $role === 'admin',
            ],


        // ===== BOSS =====
        [
            'key' => 'attendances',
            'label' => __('general.attendance'),
            'route' => safeRoute($role === 'boss', 'attendances.overview'),
            'icon' => 'fas fa-calendar-check',
            'visible' => $role === 'boss',
        ],

        // ===== BOSS =====
        //[
            //'key' => 'attendances',
            //'label' => __('general.attendance'),
            //'route' => safeRoute($role === 'boss', 'attendances.overview'),
            //'icon' => 'fas fa-calendar-check',
            //'visible' => $role === 'boss',
        //],
        [
            'key' => 'classrooms',
            'label' => __('general.classrooms'),
            'route' => safeRoute($role === 'boss', 'classrooms.index'),
            'icon' => 'fas fa-graduation-cap',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'schedules',
            'label' => __('general.schedules'),
            'route' => safeRoute($role === 'boss', 'schedules.index'),
            'icon' => 'fas fa-calendar-alt',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'assignments',
            'label' => __('general.assignments'),
            'route' => safeRoute($role === 'boss', 'assignments.overview'),
            'icon' => 'fas fa-tasks',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'grade-entry',
            'label' => 'Nhập điểm',
            'route' => safeRoute($role === 'boss', 'grade-entry.index'),
            'icon' => 'fas fa-pen',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'quizzes',
            'label' => __('general.quizzes'),
            'route' => safeRoute($role === 'boss', 'quizzes.index'),
            'icon' => 'fas fa-question-circle',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'lessons',
            'label' => __('general.lessons'),
            'route' => safeRoute($role === 'boss', 'lessons.index'),
            'icon' => 'fas fa-book',
            'visible' => $role === 'boss',
        ],
        //[
            //'key' => 'assignments',
           // 'label' => __('general.assignments'),
           // 'route' => safeRoute($role === 'boss', 'assignments.overview'),
           // 'icon' => 'fas fa-tasks',
           // 'visible' => $role === 'boss',
        //],
        
       // [
           // 'key' => 'quizzes',
           // 'label' => __('general.quizzes'),
           // 'route' => safeRoute($role === 'boss', 'quizzes.index'),
           // 'icon' => 'fas fa-question-circle',
           // 'visible' => $role === 'boss',
        //],
        //[
            //'key' => 'lessons',
           // 'label' => __('general.lessons'),
           // 'route' => safeRoute($role === 'boss', 'lessons.index'),
            //'icon' => 'fas fa-book',
            //'visible' => $role === 'boss',
       // ],
        [
            'key' => 'students',
            'label' => __('general.students'),
            'route' => safeRoute($role === 'boss', 'students.index'),
            'icon' => 'fas fa-users',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'reports',
            'label' => 'Báo cáo học tập',
            'label' => __('general.reports'),
            'route' => safeRoute($role === 'boss', 'reports.index'),
            'icon' => 'fas fa-chart-bar',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'finance',
            'label' => __('general.financial_statistics'),
            'route' => safeRoute($role === 'boss', 'admin.finance.index'),
            'icon' => 'fas fa-coins',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'evaluation-management',
            'label' => __('general.evaluation_management'),
            'route' => safeRoute($role === 'boss', 'evaluation-management'),
            'icon' => 'fas fa-star',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'notifications',
            'label' => __('general.notifications'),
            'route' => safeRoute($role === 'boss', 'notifications.index'),
            'icon' => 'fas fa-bell',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'chat',
            'label' => __('general.chat'),
            'route' => safeRoute($role === 'boss', 'chat.index'),
            'icon' => 'fas fa-comments',
            'visible' => $role === 'boss',
        ],
    ];
?>


<?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => ['active' => $active ?? null,'menuItems' => $menuItems ?? $defaultMenuItems,'brandLogo' => asset('educore-logo.png'),'brandText' => __('general.app_name'),'brandUrl' => '/','darkMode' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($active ?? null),'menu-items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menuItems ?? $defaultMenuItems),'brand-logo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('educore-logo.png')),'brand-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('general.app_name')),'brand-url' => '/','dark-mode' => true]); ?>
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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/sidebar-config.blade.php ENDPATH**/ ?>