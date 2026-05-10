<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <style>
        .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%) !important;
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .form-check-input:checked {
            background-color: #667eea !important;
            border-color: #667eea !important;
        }
    </style>
    <?php echo $__env->make('components.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal8448a995f63e2912c04e5988c6226b13 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8448a995f63e2912c04e5988c6226b13 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-language-switcher','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-language-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8448a995f63e2912c04e5988c6226b13)): ?>
<?php $attributes = $__attributesOriginal8448a995f63e2912c04e5988c6226b13; ?>
<?php unset($__attributesOriginal8448a995f63e2912c04e5988c6226b13); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8448a995f63e2912c04e5988c6226b13)): ?>
<?php $component = $__componentOriginal8448a995f63e2912c04e5988c6226b13; ?>
<?php unset($__componentOriginal8448a995f63e2912c04e5988c6226b13); ?>
<?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0 rounded-4" style="border-radius: 20px !important;">
                    <!-- Header with Logo -->
                    <div class="card-body p-sm-5">
                        <div class="text-center mb-4">
                            <div class="d-flex justify-content-center">
                                <img src="<?php echo e(asset('smash-logo.png')); ?>" alt="Logo" style="width: 80px; height: 80px;">
                            </div>

                            <h3 class="fw-bold mb-2" style="font-size: 2rem; font-weight: 700;">
                                <span class="text-primary">Sma</span><span class="text-warning">sh</span>
                            </h3>
                            <p class="text-muted mb-4"><?php echo e(__('auth.login_subtitle')); ?></p>
                        </div>

                        <form wire:submit.prevent="login">
                            <!-- Phone Input -->
                            <div class="mb-4">
                                <label for="phone" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-mobile-alt mr-2 text-primary"></i><?php echo e(__('auth.phone')); ?>

                                </label>
                                <input type="text" id="phone"
                                    class="form-control form-control-lg <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    style="border-radius: 12px; border: 2px solid #e9ecef; padding: 15px 20px;"
                                    wire:model.defer="phone" placeholder="<?php echo e(__('auth.phone_placeholder')); ?>">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-lock mr-2 text-primary"></i><?php echo e(__('auth.password_label')); ?>

                                </label>
                                <input type="password" id="password"
                                    class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    style="border-radius: 12px; border: 2px solid #e9ecef; padding: 15px 20px;"
                                    wire:model.defer="password" placeholder="<?php echo e(__('auth.password_placeholder')); ?>">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" wire:model="remember" id="remember"
                                    style="width: 18px; height: 18px;">
                                <label class="form-check-label text-muted ml-2" style="margin-top: 2px" for="remember">
                                    <?php echo e(__('auth.remember_me')); ?>

                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-semibold py-3 rounded-3 w-100"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px;">
                                    <i class="fas fa-arrow-right mr-2"></i>
                                    <?php echo e(__('auth.login_button')); ?>

                                </button>
                            </div>
                        </form>

                        <!-- Forgot Password Link -->
                        <div class="text-center mb-4">
                            <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none text-muted">
                                <?php echo e(__('auth.forgot_password')); ?>?
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-4 pt-3" style="border-top: 1px solid #e9ecef;">
                            <small class="text-muted">
                                
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/auth/login.blade.php ENDPATH**/ ?>