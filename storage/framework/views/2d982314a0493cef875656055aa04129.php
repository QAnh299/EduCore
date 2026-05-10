<?php if (isset($component)) { $__componentOriginal269d5864c76e2ab5ce407a5373eff4ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269d5864c76e2ab5ce407a5373eff4ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-student','data' => ['active' => 'chat']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-student'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'chat']); ?>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container-fluid py-2">
        <div class="row">
            <!-- Sidebar - Danh sách giáo viên và lớp học -->
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-chat-dots-fill mr-2"></i>
                            Chat & Tương tác
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- Search -->
                        <div class="p-3 border-bottom">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" wire:model.live="searchTerm" class="form-control"
                                    placeholder="Tìm kiếm...">
                            </div>
                        </div>

                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-fill" id="chatTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($activeTab === 'classes'): ?> active <?php endif; ?>"
                                    wire:click="setActiveTab('classes')" id="classes-tab" type="button" role="tab">
                                    <i class="bi bi-diagram-3-fill mr-1"></i>Lớp học
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($activeTab === 'users'): ?> active <?php endif; ?>"
                                    wire:click="setActiveTab('users')" id="users-tab" type="button" role="tab">
                                    <i class="bi bi-people-fill mr-1"></i>Giáo viên
                                </button>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content" id="chatTabsContent">
                            <!-- Classes tab -->
                            <div class="tab-pane fade <?php if($activeTab === 'classes'): ?> show active <?php endif; ?>"
                                id="classes" role="tabpanel">
                                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <button wire:click="selectClass(<?php echo e($class->id); ?>)"
                                            class="list-group-item list-group-item-action d-flex align-items-center <?php echo e($selectedClass && $selectedClass->id === $class->id ? 'active' : ''); ?>">
                                            <div class="flex-shrink-0">
                                                <!--[if BLOCK]><![endif]--><?php if(!empty($class->avatar)): ?>
                                                    <img src="<?php echo e(asset('storage/' . $class->avatar)); ?>" alt="Avatar"
                                                        class="rounded-circle"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="rounded-circle bg-info d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="bi bi-diagram-3-fill text-white"></i>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0"><?php echo e($class->name); ?></h6>
                                            </div>
                                            <span class="badge bg-danger rounded-pill ml-auto" style="min-width: 28px;">
                                                <?php echo e($class->unread_messages_count ?? 0); ?>

                                            </span>
                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="list-group-item text-center text-muted">
                                            <i class="bi bi-diagram-3-fill"
                                                style="font-size: 2rem; color: #dee2e6;"></i>
                                            <p class="mt-2">Không có lớp học nào</p>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>

                            <!-- Users tab -->
                            <div class="tab-pane fade <?php if($activeTab === 'users'): ?> show active <?php endif; ?>"
                                id="users" role="tabpanel">
                                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <button wire:click="selectUser(<?php echo e($user->id); ?>)"
                                            class="list-group-item list-group-item-action d-flex align-items-center <?php echo e($selectedUser && $selectedUser->id === $user->id ? 'active' : ''); ?>">
                                            <div class="flex-shrink-0">
                                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <span
                                                        class="text-white fw-bold"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0"><?php echo e($user->name); ?></h6>
                                                <small><?php echo e($user->email); ?></small>
                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php if($user->unread_messages_count > 0): ?>
                                                <span
                                                    class="badge bg-danger rounded-pill"><?php echo e($user->unread_messages_count); ?></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="list-group-item text-center text-muted">
                                            <i class="bi bi-people-fill" style="font-size: 2rem; color: #dee2e6;"></i>
                                            <p class="mt-2">Không có giáo viên nào</p>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main chat area -->
            <div class="col-md-7 col-lg-8">
                <div class="card shadow-sm h-100">
                    <!--[if BLOCK]><![endif]--><?php if($selectedUser || $selectedClass): ?>
                        <!-- Chat header -->
                        <div class="card-header bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <!--[if BLOCK]><![endif]--><?php if($selectedUser): ?>
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-3"
                                        style="width: 40px; height: 40px;">
                                        <span
                                            class="text-white fw-bold"><?php echo e(strtoupper(substr($selectedUser->name, 0, 1))); ?></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?php echo e($selectedUser->name); ?></h6>
                                        <small class="text-muted"><?php echo e($selectedUser->email); ?></small>
                                    </div>
                                <?php elseif($selectedClass): ?>
                                    <div class="rounded-circle bg-info d-flex align-items-center justify-content-center mr-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-diagram-3-fill text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?php echo e($selectedClass->name); ?></h6>
                                        <small class="text-muted">Lớp học</small>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!-- Messages area -->
                        <div class="card-body d-flex flex-column" style="height: 400px;">
                            <div class="flex-grow-1 overflow-auto mb-3" id="messagesContainer">
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $messages->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $isMine = $message->sender_id === auth()->id();
                                        $sender = $message->sender;
                                    ?>
                                    <div
                                        class="d-flex mb-3 <?php echo e($isMine ? 'justify-content-end' : 'justify-content-start'); ?>">
                                        <div
                                            class="d-flex <?php echo e($isMine ? 'flex-row-reverse' : 'flex-row'); ?> align-items-end">
                                            <!-- Avatar -->
                                            <div class="flex-shrink-0">
                                                <!--[if BLOCK]><![endif]--><?php if(!empty($sender->avatar)): ?>
                                                    <img src="<?php echo e(asset('storage/' . $sender->avatar)); ?>"
                                                        alt="Avatar" class="rounded-circle"
                                                        style="width: 35px; height: 35px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center <?php echo e($isMine ? 'ml-3' : 'mr-3'); ?>"
                                                        style="width: 35px; height: 35px; background-color: <?php echo e($isMine ? '#0d6efd' : '#6c757d'); ?>;">
                                                        <span
                                                            class="text-white fw-bold"><?php echo e(strtoupper(substr($sender->name, 0, 1))); ?></span>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <!-- Message content -->
                                            <div class="flex-grow-1" style="max-width: 70%;">
                                                <div
                                                    class="card <?php echo e($isMine ? 'bg-primary text-white' : 'bg-light'); ?>">
                                                    <div class="card-body py-2 px-3">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <span class="fw-bold"
                                                                style="font-size: 0.95rem;"><?php echo e($sender->name); ?></span>
                                                        </div>
                                                        <p class="mb-1"><?php echo e($message->message); ?></p>
                                                        <!--[if BLOCK]><![endif]--><?php if($message->attachment): ?>
                                                            <div class="mt-2">
                                                                <a href="<?php echo e(Storage::url($message->attachment)); ?>"
                                                                    target="_blank"
                                                                    class="btn btn-sm <?php echo e($isMine ? 'btn-light' : 'btn-outline-primary'); ?>">
                                                                    <i class="bi bi-paperclip mr-1"></i>
                                                                    Tệp đính kèm
                                                                </a>
                                                            </div>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                        <small
                                                            class="<?php echo e($isMine ? 'text-white' : 'text-muted'); ?> d-block mt-1"
                                                            style="font-size: 0.85rem;">
                                                            <?php echo e($message->created_at->format('H:i d/m/Y')); ?>

                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-center text-muted mt-5">
                                        <i class="bi bi-chat-dots" style="font-size: 3rem; color: #dee2e6;"></i>
                                        <p class="mt-3">Chưa có tin nhắn nào</p>
                                        <p>Bắt đầu cuộc trò chuyện ngay!</p>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Message input with drag & drop -->
                            <div class="border-top pt-3">
                                <form wire:submit.prevent="sendMessage" enctype="multipart/form-data">
                                    <div class="row g-2">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="text" wire:model="messageText" class="form-control"
                                                    placeholder="Nhập tin nhắn..." maxlength="1000">
                                                <input type="file" wire:model="attachment" id="attachment" class="d-none" accept="image/*,audio/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.7z">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('attachment').click()">
                                                    <i class="bi bi-paperclip"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-send"></i>
                                                </button>
                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger d-block mt-1"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                            <!--[if BLOCK]><![endif]--><?php if($attachment): ?>
                                                <small class="text-muted">
                                                    <i class="bi bi-paperclip"></i>
                                                    <?php echo e($attachment->getClientOriginalName()); ?>

                                                </small>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['messageText'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                </form>

                                <!-- Drag & Drop Zone -->
                                <div id="dragDropZone"
                                    class="mt-2 p-3 border-2 border-dashed border-secondary rounded text-center"
                                    style="display: none; background-color: rgba(0,123,255,0.1);">
                                    <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                    <p class="mb-0 mt-2">Kéo thả file vào đây để đính kèm</p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Welcome screen -->
                        <div class="card-body d-flex align-items-center justify-content-center"
                            style="height: 400px;">
                            <div class="text-center">
                                <i class="bi bi-chat-dots-fill" style="font-size: 4rem; color: #0dcaf0;"></i>
                                <h4 class="mt-3">Chào mừng đến với Chat & Tương tác</h4>
                                <p class="text-muted">Chọn một lớp học hoặc giáo viên để bắt đầu cuộc trò chuyện</p>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>
    </div>

        <?php
        $__scriptKey = '674863725-0';
        ob_start();
    ?>
        <script>
            // File upload handling
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('attachment');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            console.log('File selected:', file.name, file.size, file.type);
                            // Gửi file qua Livewire
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('attachment', file);
                        }
                    });
                }
            });

            // Auto scroll to bottom when new messages arrive
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('messageSent', () => {
                    setTimeout(() => {
                        const container = document.getElementById('messagesContainer');
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }, 100);
                });

                // Real-time message updates
                Livewire.on('messageReceived', () => {
                    // Show notification
                    if (Notification.permission === 'granted') {
                        new Notification('Tin nhắn mới', {
                            body: 'Bạn có tin nhắn mới',
                            icon: '/favicon.ico'
                        });
                    }

                    // Auto scroll to bottom
                    setTimeout(() => {
                        const container = document.getElementById('messagesContainer');
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }, 100);
                });

                // Listen to Pusher events
                if (window.Echo) {
                    // Listen to private user channels
                    window.Echo.private(`chat-user-${<?php echo \Illuminate\Support\Js::from(auth()->id())->toHtml() ?>}`)
                        .listen('.message.sent', (e) => {
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('handleNewMessage', e);
                        });

                    // Listen to class channels (nếu đang ở trong class chat)
                    <?php if($selectedClass): ?>
                        window.Echo.channel(`chat-class-${<?php echo \Illuminate\Support\Js::from($selectedClass->id)->toHtml() ?>}`)
                            .listen('.message.sent', (e) => {
                                window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('handleNewMessage', e);
                            });
                    <?php endif; ?>
                }
            });

            // Request notification permission
            if (Notification.permission === 'default') {
                Notification.requestPermission();
            }

            // Drag & Drop functionality
            document.addEventListener('DOMContentLoaded', function() {
                const dragDropZone = document.getElementById('dragDropZone');
                const messageInput = document.querySelector('input[wire\\:model="messageText"]');
                const fileInput = document.getElementById('attachment');

                if (dragDropZone && messageInput) {
                    // Show drag zone when hovering over input area
                    messageInput.addEventListener('dragenter', function(e) {
                        e.preventDefault();
                        dragDropZone.style.display = 'block';
                    });

                    messageInput.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        dragDropZone.style.display = 'block';
                    });

                    messageInput.addEventListener('dragleave', function(e) {
                        e.preventDefault();
                        if (!dragDropZone.contains(e.relatedTarget)) {
                            dragDropZone.style.display = 'none';
                        }
                    });

                    // Handle file drop
                    dragDropZone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        dragDropZone.style.background = 'rgba(0,123,255,0.2)';
                    });

                    dragDropZone.addEventListener('dragleave', function(e) {
                        e.preventDefault();
                        dragDropZone.style.background = 'rgba(0,123,255,0.1)';
                    });

                    dragDropZone.addEventListener('drop', function(e) {
                        e.preventDefault();
                        dragDropZone.style.display = 'none';
                        dragDropZone.style.background = 'rgba(0,123,255,0.1)';

                        const files = e.dataTransfer.files;
                        if (files.length > 0) {
                            // Create a new FileList-like object
                            const dt = new DataTransfer();
                            dt.items.add(files[0]);
                            fileInput.files = dt.files;

                            // Trigger Livewire file upload
                            fileInput.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        }
                    });

                    // Hide drag zone when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!dragDropZone.contains(e.target) && !messageInput.contains(e.target)) {
                            dragDropZone.style.display = 'none';
                        }
                    });
                }
            });

            // Real-time typing indicator
            let typingTimer;
            const messageInput = document.querySelector('input[wire\\:model="messageText"]');
            if (messageInput) {
                messageInput.addEventListener('input', () => {
                    clearTimeout(typingTimer);
                    // You can add typing indicator logic here
                    typingTimer = setTimeout(() => {
                        // Stop typing indicator
                    }, 1000);
                });
            }
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('livewire:load', function() {
                // Hiển thị toast khi có thông báo
                Livewire.on('showToast', function(data) {
                    let type = data.type || 'info';
                    let message = data.message || '';
                    let toast = document.createElement('div');
                    toast.className = 'toast align-items-center text-bg-' + (type === 'success' ? 'success' : (
                            type === 'error' ? 'danger' : 'info')) +
                        ' border-0 position-fixed bottom-0 end-0 m-3';
                    toast.style.zIndex = 9999;
                    toast.innerHTML =
                        `<div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white mr-2 m-auto" data-bs-dismiss="toast"></button></div>`;
                    document.body.appendChild(toast);
                    var bsToast = new bootstrap.Toast(toast, {
                        delay: 2500
                    });
                    bsToast.show();
                    toast.addEventListener('hidden.bs.toast', function() {
                        toast.remove();
                    });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

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
<?php /**PATH C:\xampp\htdocs\educore\resources\views/student/chat/index.blade.php ENDPATH**/ ?>