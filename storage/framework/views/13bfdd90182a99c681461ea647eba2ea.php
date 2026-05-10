<?php if (isset($component)) { $__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-admin','data' => ['title' => 'Dashboard','active' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard','active' => 'home']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Unread Messages -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($unreadCount); ?></h3>
                    <p><?php echo e(__('general.unread_messages')); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                <a href="<?php echo e(route('chat.index')); ?>" class="small-box-footer">
                    <?php echo e(__('general.view_more')); ?> <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <!-- Unread Notifications -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($unreadNotification); ?></h3>
                    <p><?php echo e(__('general.unread_notifications')); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-bell"></i>
                </div>
                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                <a href="<?php echo e(route('notifications.index')); ?>" class="small-box-footer">
                    <?php echo e(__('general.view_more')); ?> <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <!-- Total Students -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e(\App\Models\User::where('role', 'student')->count()); ?></h3>
                    <p><?php echo e(__('general.total_students')); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                <a href="<?php echo e(route('students.index')); ?>" class="small-box-footer">
                    <?php echo e(__('general.view_more')); ?> <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo e(\App\Models\User::where('role', 'teacher')->count()); ?></h3>
                    <p><?php echo e(__('general.total_teachers')); ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <?php if(auth()->user()->role === 'admin'): ?>
                <a href="<?php echo e(route('users.index')); ?>" class="small-box-footer">
                    <?php echo e(__('general.view_more')); ?> <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
                        <?php echo e(__('general.quick_actions')); ?>

                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Quản lý người dùng & phân quyền -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('users.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-users" style="font-size:2.5rem; color:#0d6efd;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.manage_users'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Quản lý lớp học -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('classrooms.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-graduation-cap" style="font-size:2.5rem; color:#fd7e14;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.manage_classrooms'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Lịch học -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('schedules.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-alt" style="font-size:2.5rem; color:#6f42c1;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.schedules'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Quản lý học viên -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('students.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-user-graduate" style="font-size:2.5rem; color:#20c997;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.manage_students'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Điểm danh -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('attendances.overview')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-clipboard-check" style="font-size:2.5rem; color:#ffc107;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.attendance'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Giao bài tập -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('assignments.overview')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-tasks" style="font-size:2.5rem; color:#fd5e53;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.assign_homework'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Chấm bài 
                        <div class="col-6 col-md-3 text-center mb-4">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-check-circle" style="font-size:2.5rem; color:#6f42c1;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.grading'); ?></div>
                            </a>
                        </div> -->
                        <!-- Kiểm tra & Quiz -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('quizzes.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-question-circle" style="font-size:2.5rem; color:#b23cfd;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.quizzes'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Xem lại bài học & tài nguyên -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('lessons.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-book" style="font-size:2.5rem; color:#28a745;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.lessons'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Thống kê - báo cáo -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('reports.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-chart-bar" style="font-size:2.5rem; color:#ff9800;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.statistics_reports'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Thống kê thu chi -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('admin.finance.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-coins" style="font-size:2.5rem; color:#ffc107;"></i>
                                </div>
                                <div><?php echo e(__('general.financial_statistics')); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Quản lý đánh giá -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('evaluation-management')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-star" style="font-size:2.5rem; color:#e91e63;"></i>
                                </div>
                                <div><?php echo e(__('general.evaluation_management')); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Thông báo & nhắc lịch -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('notifications.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2 position-relative d-inline-block">
                                    <i class="fas fa-bell" style="font-size:2.5rem; color:#f59e42;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.notifications_reminders'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!-- Chat -->
                        <div class="col-6 col-md-3 text-center mb-4">
                            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'boss'): ?>
                            <a href="<?php echo e(route('chat.index')); ?>" class="text-decoration-none text-dark">
                                <div class="mb-2">
                                    <i class="fas fa-comments" style="font-size:2.5rem; color:#17a2b8;"></i>
                                </div>
                                <div><?php echo app('translator')->get('general.chat'); ?></div>
                            </a><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        <?php echo e(__('general.attendance_statistics')); ?>

                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        <?php echo e(__('general.recent_activities')); ?>

                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <!-- Timeline items would go here -->
                        <div class="time-label">
                            <span class="bg-red"><?php echo e(__('general.today')); ?></span>
                        </div>
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i>
                                    <?php echo e(__('general.minutes_ago', ['count' => 2])); ?></span>
                                <h3 class="timeline-header"><?php echo e(__('general.new_teacher_message')); ?></h3>
                                <div class="timeline-body">
                                    <?php echo e(__('general.unread_messages_count', ['count' => $unreadCount])); ?>

                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-bell bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i>
                                    <?php echo e(__('general.minutes_ago', ['count' => 5])); ?></span>
                                <h3 class="timeline-header"><?php echo e(__('general.new_notification')); ?></h3>
                                <div class="timeline-body">
                                    <?php echo e(__('general.unread_notifications_count', ['count' => $unreadNotification])); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            // Chart.js for attendance statistics (live data)
            document.addEventListener('DOMContentLoaded', function() {
                function ensureChartJsLoaded(callback) {
                    if (window.Chart) return callback();
                    var s = document.createElement('script');
                    s.src = 'https://cdn.jsdelivr.net/npm/chart.js';
                    s.onload = callback;
                    document.head.appendChild(s);
                }

                function renderDashboardAttendanceChart() {
                    const el = document.getElementById('attendanceChart');
                    if (!el) return;
                    const ctx = el.getContext('2d');

                    //tạm bỏ 3 dòng dưới
                    //const present = <?php echo e((int) ($attendanceStatusCounts['present'] ?? 0)); ?>;
                    //const absent = <?php echo e((int) ($attendanceStatusCounts['absent'] ?? 0)); ?>;
                    //const late = <?php echo e((int) ($attendanceStatusCounts['late'] ?? 0)); ?>;

                    //thay 3 dòng trên bằng
                    const dataFromBlade = <?php echo \Illuminate\Support\Js::from([
                        'present' => (int) ($attendanceStatusCounts['present'] ?? 0),
                        'absent' => (int) ($attendanceStatusCounts['absent'] ?? 0),
                        'late' => (int) ($attendanceStatusCounts['late'] ?? 0),
                    ])->toHtml() ?>;
                    const present = dataFromBlade.present;
                    const absent  = dataFromBlade.absent;
                    const late    = dataFromBlade.late;

                    // Tháng/Năm đang chọn (nếu có) hoặc mặc định tháng/năm hiện tại
                    const selectedMonth = <?php echo e((int) ($selectedMonth ?? now()->month)); ?>;
                    const selectedYear = <?php echo e((int) ($selectedYear ?? now()->year)); ?>;
                    const monthStr = String(selectedMonth).padStart(2, '0') + '/' + selectedYear;
                    const noDataTemplate = "<?php echo e(__('general.no_data_for_month', ['month' => ':month'])); ?>";
                    const noDataLabel = noDataTemplate.replace(':month', monthStr);

                    if (el._chartInstance) {
                        el._chartInstance.destroy();
                        el._chartInstance = null;
                    }

                    // Nếu không có dữ liệu, hiển thị lát cắt xám "Chưa có dữ liệu MM/YYYY"
                    const total = present + absent + late;
                    //thay dòng let labels bên dưới bằng
                    //let labels = ['<?php echo e(__('general.present')); ?>', '<?php echo e(__('general.absent')); ?>'];
                    'presentLabel' => __('general.present'),
                    'absentLabel'  => __('general.absent'),
                    'lateLabel'    => __('general.late'),
                    labels = [
                        dataFromBlade.presentLabel,
                        dataFromBlade.absentLabel,
                        dataFromBlade.lateLabel
                    ];
                    let data = [present, absent];
                    let backgroundColor = ['#28a745', '#dc3545', '#ffc107'];

                    if (total === 0) {
                        labels = [noDataLabel];
                        data = [1];
                        backgroundColor = ['#e9ecef'];
                    }

                    const isNoData = labels.length === 1 && labels[0] === noDataLabel;

                    el._chartInstance = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: backgroundColor,
                                borderWidth: 0,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    enabled: !isNoData
                                }
                            }
                        }
                    });
                }

                function init() {
                    ensureChartJsLoaded(renderDashboardAttendanceChart);
                }
                init();

                // Re-render after Livewire updates the DOM
                document.addEventListener('livewire:load', function() {
                    /*if (window.Livewire) {
                        window.Livewire.hook('message.processed', function() {
                            init();
                        });
                    }*/
                   if (window.Livewire) {
                        window.Livewire.hook('message.processed', init);
                        window.Livewire.hook('morph.updated', init);
                    }
                });
                if (window.Livewire && window.Livewire.hook) {
                    window.Livewire.hook('morph.updated', function() {
                        init();
                    });
                }
            });
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe)): ?>
<?php $attributes = $__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe; ?>
<?php unset($__attributesOriginal506262fece31ca48bdbf57b1ac6fd3fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe)): ?>
<?php $component = $__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe; ?>
<?php unset($__componentOriginal506262fece31ca48bdbf57b1ac6fd3fe); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/admin/home.blade.php ENDPATH**/ ?>