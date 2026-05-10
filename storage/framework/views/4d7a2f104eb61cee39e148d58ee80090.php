<?php if (isset($component)) { $__componentOriginalf2c05110f7630f709271885c25ac6f7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2c05110f7630f709271885c25ac6f7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dash-teacher','data' => ['active' => 'profile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dash-teacher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'profile']); ?>
<div class="container-fluid py-4">

    <div class="card">
        <div class="card-header">
            <h4>Thông tin tài khoản</h4>
        </div>
        <div class="card-body">

            <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php if(session()->has('password_success')): ?>
                <div class="alert alert-success"><?php echo e(session('password_success')); ?></div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <form wire:submit.prevent="updateProfile">
                <div class="mb-3">
                    <label class="font-weight-bold">Họ tên</label>
                    <input type="text" wire:model="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" value="<?php echo e(auth()->user()->email); ?>" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Số điện thoại</label>
                    <input type="text" wire:model="phone" class="form-control">
                </div>
                <button class="btn btn-primary mb-4">Cập nhật thông tin</button>
            </form>

            <hr>

            
            <h5 class="mb-3">Đổi mật khẩu</h5>
            <form wire:submit.prevent="updatePassword">
                <div class="mb-3">
                    <label class="font-weight-bold">Mật khẩu hiện tại</label>
                    <input type="password" wire:model="current_password" class="form-control">
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger small"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Mật khẩu mới</label>
                    <input type="password" wire:model="new_password" class="form-control">
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger small"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Xác nhận mật khẩu mới</label>
                    <input type="password" wire:model="new_password_confirmation" class="form-control">
                </div>
                <button class="btn btn-warning">Đổi mật khẩu</button>
            </form>

        </div>
    </div>

</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf2c05110f7630f709271885c25ac6f7c)): ?>
<?php $attributes = $__attributesOriginalf2c05110f7630f709271885c25ac6f7c; ?>
<?php unset($__attributesOriginalf2c05110f7630f709271885c25ac6f7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf2c05110f7630f709271885c25ac6f7c)): ?>
<?php $component = $__componentOriginalf2c05110f7630f709271885c25ac6f7c; ?>
<?php unset($__componentOriginalf2c05110f7630f709271885c25ac6f7c); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\educore\resources\views/teacher/profile.blade.php ENDPATH**/ ?>