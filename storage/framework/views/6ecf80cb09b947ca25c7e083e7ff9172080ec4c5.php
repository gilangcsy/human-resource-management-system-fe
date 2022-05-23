<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu">
        <div class="row">
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-40"><img src="<?php echo e(asset('assets/img/demo/social_app.svg')); ?>" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-10"><img src="<?php echo e(asset('assets/img/demo/email_app.svg')); ?>" alt="socail">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-40"><img src="<?php echo e(asset('assets/img/demo/calendar_app.svg')); ?>" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-10"><img src="<?php echo e(asset('assets/img/demo/add_more.svg')); ?>" alt="socail">
                </a>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="logo" class="brand" data-src="<?php echo e(asset('assets/img/logo.png')); ?>"
            data-src-retina="<?php echo e(asset('assets/img/logo.png')); ?>" width="100">
        <div class="sidebar-header-controls ml-4">
            <button aria-label="Pin Menu" type="button"
                class="btn btn-icon-link invert d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none"
                data-toggle-pin="sidebar">
                <i class="pg-icon"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <?php if (isset($component)) { $__componentOriginalc10f37b788d950f4de70296a6d42abeba78fa736 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SidebarLayout::class, []); ?>
<?php $component->withName('sidebar-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc10f37b788d950f4de70296a6d42abeba78fa736)): ?>
<?php $component = $__componentOriginalc10f37b788d950f4de70296a6d42abeba78fa736; ?>
<?php unset($__componentOriginalc10f37b788d950f4de70296a6d42abeba78fa736); ?>
<?php endif; ?>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL--><?php /**PATH /home/intranet/public_html/resources/views/dashboard/partials/sidebar.blade.php ENDPATH**/ ?>