@php
    // Cấu hình menu mặc định cho giáo viên
    $assistantMenuItems = [
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
            'route' => route('assistant.my-class.index'),
            'icon' => 'bi bi-diagram-3',
            'visible' => true,
        ],
        [
            'key' => 'schedules',
            'label' => __('general.schedules'),
            'route' => route('assistant.schedules.index'),
            'icon' => 'bi bi-calendar3',
            'visible' => true,
        ],
        [
            'key' => 'attendances',
            'label' => __('general.attendance'),
            'route' => route('assistant.attendance.overview'),
            'icon' => 'bi bi-calendar-check',
            'visible' => true,
        ],
        [
            'key' => 'lessons',
            'label' => __('general.lessons'),
            'route' => route('assistant.lessons.index'),
            'icon' => 'bi bi-book',
            'visible' => true,
        ],
        [
            'key' => 'assignments',
            'label' => __('general.assignments'),
            'route' => route('assistant.assignments.index'),
            'icon' => 'bi bi-journal-text',
            'visible' => true,
        ],
        [
            'key' => 'quizzes',
            'label' => __('general.quizzes'),
            'route' => route('assistant.quizzes.index'),
            'icon' => 'bi bi-patch-question',
            'visible' => true,
        ],
        [
            'key' => 'grade-entry',
            'label' => 'Nhập điểm',
            'route' => route('assistant.grade-entry-assistant.index'),
            'icon' => 'fas fa-pen',
            'visible' => true,
        ],
        [
            'key' => 'notifications',
            'label' => __('general.notifications'),
            'route' => route('assistant.notifications.index'),
            'icon' => 'bi bi-bell',
            'visible' => true,
        ],
        [
            'key' => 'chat',
            'label' => __('general.chat'),
            'route' => route('assistant.chat.index'),
            'icon' => 'bi bi-chat-dots',
            'visible' => true,
        ],
        [
            'key' => 'reports',
            'label' => __('general.class_reports'),
            'route' => route('assistant.reports.index'),
            'icon' => 'bi bi-bar-chart',
            'visible' => true,
        ],
        
@endphp

{{-- Component sidebar với cấu hình menu cho giáo viên --}}
<x-sidebar :active="$active ?? null" :menu-items="$menuItems ?? $assistantMenuItems" :brand-logo="asset('educore-logo.png')" :brand-text="__('general.app_name')" brand-url="/" :dark-mode="true" />
