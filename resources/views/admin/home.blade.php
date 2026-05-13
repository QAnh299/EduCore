<x-layouts.dash-admin title="Dashboard" active="home">
    @include('components.language')

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Unread Messages -->
         @if(auth()->user()->role === 'boss')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $unreadCount }}</h3>
                    <p>{{ __('general.unread_messages') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                @if(auth()->user()->role === 'boss')
                <a href="{{ route('chat.index') }}" class="small-box-footer">
                    {{ __('general.view_more') }} <i class="fas fa-arrow-circle-right"></i>
                </a>@endif
            </div>
        </div>@endif

        <!-- Unread Notifications -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $unreadNotification }}</h3>
                    <p>{{ __('general.unread_notifications') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bell"></i>
                </div>
                @if(auth()->user()->role === 'boss')
                <a href="{{ route('notifications.index') }}" class="small-box-footer">
                    {{ __('general.view_more') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Total Students -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\User::where('role', 'student')->count() }}</h3>
                    <p>{{ __('general.total_students') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                @if(auth()->user()->role === 'boss')
                <a href="{{ route('students.index') }}" class="small-box-footer">
                    {{ __('general.view_more') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\User::whereIn('role', ['teacher', 'assistant'])->count() }}</h3>
                    <p>{{ __('general.total_teachers') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>

                @if(in_array(auth()->user()->role, ['admin', 'boss']))
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    {{ __('general.view_more') }} <i class="fas fa-arrow-circle-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tachometer-alt mr-1"></i>
                        {{ __('general.quick_actions') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <!-- Quản lý người dùng (Admin) -->
                        @if(auth()->user()->role === 'admin')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('users.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-graduation-cap" style="font-size:2.5rem; color:#fd7e14;"></i>
                                </div>
                                <div>@lang('general.manage_users')</div>
                            </a>
                        </div>
                        @endif

                        <!-- Quản lý lớp học -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('classrooms.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-graduation-cap" style="font-size:2.5rem; color:#fd7e14;"></i>
                                </div>
                                <div>@lang('general.manage_classrooms')</div>
                            </a>
                        </div>
                        @endif

                        <!-- Lịch học -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('schedules.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-alt" style="font-size:2.5rem; color:#6f42c1;"></i>
                                </div>
                                <div>@lang('general.schedules')</div>
                            </a>
                        </div>
                        @endif

                        <!-- Quản lý học viên -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('students.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-user-graduate" style="font-size:2.5rem; color:#20c997;"></i>
                                </div>
                                <div>@lang('general.manage_students')</div>
                            </a>
                        </div>
                        @endif

                        

                        <!-- Thống kê - Báo cáo -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            @if(auth()->user()->role === 'boss')
                            <a href="{{ route('reports.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-chart-bar" style="font-size:2.5rem; color:#ff9800;"></i>
                                </div>
                                <div>@lang('general.statistics_reports')</div>
                            </a>@endif
                        </div>
                        @endif

                        <!-- Thống kê thu chi -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('admin.finance.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-coins" style="font-size:2.5rem; color:#ffc107;"></i>
                                </div>
                                <div>{{ __('general.financial_statistics') }}</div>
                            </a>
                        </div>
                        @endif

                        <!-- Đánh giá -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('evaluation-management') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-star" style="font-size:2.5rem; color:#e91e63;"></i>
                                </div>
                                <div>{{ __('general.evaluation_management') }}</div>
                            </a>
                        </div>
                        @endif

                        <!-- Thông báo -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('notifications.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2 position-relative d-inline-block">
                                    <i class="fas fa-bell" style="font-size:2.5rem; color:#f59e42;"></i>
                                </div>
                                <div>@lang('general.notifications_reminders')</div>
                            </a>
                        </div>
                        @endif

                        <!-- Chat -->
                        @if(auth()->user()->role === 'boss')
                        <div class="col-6 col-md-3 text-center mb-4">
                            
                            <a href="{{ route('chat.index') }}" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-comments" style="font-size:2.5rem; color:#17a2b8;"></i>
                                </div>
                                <div>@lang('general.chat')</div>
                            </a>
                        </div> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    @if(auth()->user()->role === 'boss')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        {{ __('general.attendance_statistics') }}
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChart" 
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
                    </canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        {{ __('general.recent_activities') }}
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Bạn có thể thêm timeline ở đây -->
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function ensureChartJsLoaded(callback) {
                if (window.Chart) return callback();
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
                script.onload = callback;
                document.head.appendChild(script);
            }

            function renderDashboardAttendanceChart() {
                const el = document.getElementById('attendanceChart');
                if (!el) return;

                const ctx = el.getContext('2d');

                const dataFromBlade = @js([
                    'present' => (int) ($attendanceStatusCounts['present'] ?? 0),
                    'absent'  => (int) ($attendanceStatusCounts['absent'] ?? 0),
                    'late'    => (int) ($attendanceStatusCounts['late'] ?? 0),
                ]);

                const present = dataFromBlade.present;
                const absent  = dataFromBlade.absent;
                const late    = dataFromBlade.late;

                const selectedMonth = {{ (int) ($selectedMonth ?? now()->month) }};
                const selectedYear  = {{ (int) ($selectedYear ?? now()->year) }};
                const monthStr = String(selectedMonth).padStart(2, '0') + '/' + selectedYear;

                if (el._chartInstance) {
                    el._chartInstance.destroy();
                }

                const total = present + absent + late;
                let labels = [
                    "{{ __('general.present') }}",
                    "{{ __('general.absent') }}",
                    "{{ __('general.late') }}"
                ];
                let data = [present, absent, late];
                let backgroundColor = ['#28a745', '#dc3545', '#ffc107'];

                if (total === 0) {
                    labels = ["{{ __('general.no_data_for_month', ['month' => ':month']) }}".replace(':month', monthStr)];
                    data = [1];
                    backgroundColor = ['#e9ecef'];
                }

                el._chartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColor,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' },
                            tooltip: { enabled: total > 0 }
                        }
                    }
                });
            }

            ensureChartJsLoaded(renderDashboardAttendanceChart);

            // Livewire support
            if (window.Livewire) {
                window.Livewire.hook('morph.updated', renderDashboardAttendanceChart);
            }
        });
    </script>
    @endpush
</x-layouts.dash-admin>