<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;

        window.codeTube = {
            url: '<?php echo e(config('app.url')); ?>',
            user: {
                id:<?php echo e(Auth::check()?Auth::user()->id:nul); ?>,
                authenticated:<?php echo e(Auth::check()?'true':'false'); ?>

            }
        };
    </script>
</head>
<body>
<div id="app">
    <?php echo $__env->make('layouts.partials._navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>

<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
