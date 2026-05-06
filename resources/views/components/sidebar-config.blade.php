@php
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
        [
            'key' => 'students',
            'label' => __('general.students'),
            'route' => safeRoute($role === 'boss', 'students.index'),
            'icon' => 'fas fa-users',
            'visible' => $role === 'boss',
        ],
        [
            'key' => 'reports',
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
@endphp

{{-- Component sidebar với cấu hình menu mặc định --}}
<x-sidebar :active="$active ?? null" :menu-items="$menuItems ?? $defaultMenuItems" :brand-logo="asset('educore-logo.png')" :brand-text="__('general.app_name')" brand-url="/" :dark-mode="true" />
