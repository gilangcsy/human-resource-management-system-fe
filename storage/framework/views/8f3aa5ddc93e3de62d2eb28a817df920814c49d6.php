<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Auth &mdash; IDS Intranet</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="https://secure.gravatar.com/avatar/d6c3b7355777d2933834e7e032e12cfa?s=500&d=mm&r=g" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app."
        name="description" />
    <meta content="Ace" name="author" />
    <link href="<?php echo e(asset('assets/plugins/pace/pace-theme-flash.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet')); ?>" type="text/css"
        media="screen" />
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="<?php echo e(asset('pages/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        window.onload = function() {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML +=
                '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
        }
    </script>
</head>

<body class="fixed-header ">
    <div class="login-wrapper ">
        <?php echo $__env->yieldContent('content'); ?>
    <!-- BEGIN VENDOR JS -->
    <script src="<?php echo e(asset('assets/plugins/pace/pace.min.js')); ?>" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="<?php echo e(asset('assets/plugins/liga.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery-3.2.1.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/modernizr.custom.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-ui/jquery-ui.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/popper/umd/popper.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery-easy.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-actual/jquery.actual.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/classie/classie.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>

    <?php echo $__env->yieldContent('javascript'); ?>
    <!-- END VENDOR JS -->
    <script src="pages/js/pages.min.js"></script>
    <script>
        $(function() {
            $('#form-login').validate()
        })
    </script>
</body>

</html>
<?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/auth/partials/app.blade.php ENDPATH**/ ?>