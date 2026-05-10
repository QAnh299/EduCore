<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'active' => null,
    'brandLogo' => asset('smash-logo.png'),
    'brandText' => __('general.app_name'),
    'brandUrl' => '/',
    'menuItems' => [],
    'darkMode' => true,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'active' => null,
    'brandLogo' => asset('smash-logo.png'),
    'brandText' => __('general.app_name'),
    'brandUrl' => '/',
    'menuItems' => [],
    'darkMode' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar <?php echo e($darkMode ? 'sidebar-dark-primary' : 'sidebar-light-primary'); ?> elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e($brandUrl); ?>" class="brand-link d-flex align-items-center">
        <img src="<?php echo e(asset('smash-logo.png')); ?>" alt="Logo" style="width: 60px; height: 60px;">
        <span class="brand-text font-weight-light"><?php echo e($brandText); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if(isset($item['children']) && count($item['children']) > 0): ?>
                        <!-- Menu với submenu -->
                        <li
                            class="nav-item <?php echo e($active === $item['key'] || in_array($active, collect($item['children'])->pluck('key')->toArray()) ? 'menu-open' : ''); ?>">
                            <a href="#"
                                class="nav-link <?php echo e($active === $item['key'] || in_array($active, collect($item['children'])->pluck('key')->toArray()) ? 'active' : ''); ?>">
                                <i class="nav-icon <?php echo e($item['icon'] ?? 'fas fa-circle'); ?>"></i>
                                <p>
                                    <?php echo e($item['label']); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!--[if BLOCK]><![endif]--><?php if(isset($child['visible']) && !$child['visible']): ?>
                                        <?php continue; ?>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <li class="nav-item">
                                        <a href="<?php echo e($child['route']); ?>"
                                            class="nav-link <?php echo e($active === $child['key'] ? 'active' : ''); ?>">
                                            <i class="nav-icon <?php echo e($child['icon'] ?? 'far fa-circle'); ?>"></i>
                                            <p><?php echo e($child['label']); ?></p>
                                            <!--[if BLOCK]><![endif]--><?php if(isset($child['badge'])): ?>
                                                <span
                                                    class="badge badge-<?php echo e($child['badge']['type'] ?? 'info'); ?> right">
                                                    <?php echo e($child['badge']['text']); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- Menu đơn giản -->
                        <!--[if BLOCK]><![endif]--><?php if(isset($item['visible']) && !$item['visible']): ?>
                            <?php continue; ?>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <li class="nav-item">
                            <a href="<?php echo e($item['route']); ?>"
                                class="nav-link <?php echo e($active === $item['key'] ? 'active' : ''); ?>">
                                <i class="nav-icon <?php echo e($item['icon'] ?? 'fas fa-circle'); ?>"></i>
                                <p>
                                    <?php echo e($item['label']); ?>

                                    <!--[if BLOCK]><![endif]--><?php if(isset($item['badge'])): ?>
                                        <span class="badge badge-<?php echo e($item['badge']['type'] ?? 'info'); ?> right">
                                            <?php echo e($item['badge']['text']); ?>

                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </p>
                            </a>
                        </li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/sidebar.blade.php ENDPATH**/ ?>