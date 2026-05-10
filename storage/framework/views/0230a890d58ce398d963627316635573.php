<style>
    .dropdown-menu .dropdown-item.active,
    .dropdown-menu .dropdown-item.active:hover,
    .dropdown-menu .dropdown-item.active:focus {
        background-color: #007bff !important;
        /* giữ màu xanh Bootstrap primary */
        color: #fff !important;
    }

    /* Không làm mờ màu active khi hover chung */
    .dropdown-menu .dropdown-item:hover {
        color: inherit;
    }
</style>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
        <!--[if BLOCK]><![endif]--><?php switch(app()->getLocale()):
            case ('vi'): ?>
                <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1fb-1f1f3.svg" class="mb-1" width="16" height="16"
                    alt="VN">
                <span class="d-none d-md-inline"><?php echo app('translator')->get('general.vietnamese'); ?></span>
            <?php break; ?>

            <?php case ('en'): ?>
                <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1ec-1f1e7.svg" class="mb-1" width="16" height="16"
                    alt="GB">
                <span class="d-none d-md-inline"><?php echo app('translator')->get('general.english'); ?></span>
            <?php break; ?>

            <?php case ('zh'): ?>
                <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1e8-1f1f3.svg" class="mb-1" width="16" height="16"
                    alt="CN">
                <span class="d-none d-md-inline"><?php echo app('translator')->get('general.chinese'); ?></span>
            <?php break; ?>

            <?php default: ?>
                <span class="d-none d-md-inline"><?php echo app('translator')->get('general.language'); ?></span>
        <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="<?php echo e(route('lang.switch', 'vi')); ?>"
            class="dropdown-item <?php echo e(app()->getLocale() == 'vi' ? 'active' : ''); ?>">
            <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1fb-1f1f3.svg" class="mb-1" width="16"
                height="16" alt="VN">
            <?php echo app('translator')->get('general.vietnamese'); ?>
            <!--[if BLOCK]><![endif]--><?php if(app()->getLocale() == 'vi'): ?>
                <i class="fas fa-check ml-2 text-white"></i>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </a>
        <a href="<?php echo e(route('lang.switch', 'en')); ?>"
            class="dropdown-item <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>">
            <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1ec-1f1e7.svg" class="mb-1" width="16"
                height="16" alt="GB">
            <?php echo app('translator')->get('general.english'); ?>
            <?php if(app()->getLocale() == 'en'): ?>
                <i class="fas fa-check ml-2 text-white"></i>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </a>
        <a href="<?php echo e(route('lang.switch', 'zh')); ?>"
            class="dropdown-item <?php echo e(app()->getLocale() == 'zh' ? 'active' : ''); ?>">
            <img src="https://twemoji.maxcdn.com/v/latest/svg/1f1e8-1f1f3.svg" class="mb-1" width="16"
                height="16" alt="CN">
            <?php echo app('translator')->get('general.chinese'); ?>
            <?php if(app()->getLocale() == 'zh'): ?>
                <i class="fas fa-check ml-2 text-white"></i>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </a>
    </div>
</li>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/language-switcher.blade.php ENDPATH**/ ?>