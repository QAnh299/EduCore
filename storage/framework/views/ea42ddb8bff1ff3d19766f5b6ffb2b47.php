<?php
    $locale = Session::get('locale', config('app.locale'));

    if (in_array($locale, ['vi', 'en', 'zh'])) {
        app()->setLocale($locale);
    }
?>
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/language.blade.php ENDPATH**/ ?>