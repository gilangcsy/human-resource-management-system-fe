<!-- START HEADER -->
<div class="header ">
    <!-- START MOBILE SIDEBAR TOGGLE -->
    <a href="#" class="btn-link toggle-sidebar d-lg-none pg-icon btn-icon-link" data-toggle="sidebar">
        menu</a>
    <!-- END MOBILE SIDEBAR TOGGLE -->
    <div class="">
        <div class="brand inline ml-lg-5">
            <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="logo" data-src="<?php echo e(asset('assets/img/logo.png')); ?>"
                data-src-retina="<?php echo e(asset('assets/img/logo.png')); ?>" width="150" class="img-fluid">
        </div>
        <!-- START NOTIFICATION LIST -->
        <!-- END NOTIFICATIONS LIST -->
    </div>
    <div class="d-flex align-items-center">
        <!-- START User Info-->
        <div class="dropdown pull-right d-lg-block">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" aria-label="profile dropdown">
                <span class="thumbnail-wrapper d32 circular inline">
                    <img src="<?php echo e(asset('assets/img/profiles/avatar.jpg')); ?>" alt="" data-src="<?php echo e(asset('assets/img/gallery/'. rand(1,14) .'.jpg')); ?>"
                        data-src-retina="<?php echo e(asset('assets/img/profiles/avatar_small2x.jpg')); ?>" width="32" height="32">
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                <a href="#" class="dropdown-item"><span>Signed in as <br /><b><?php echo e(Session::get('full_name')); ?></b></span></a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('auth.logout')); ?>" class="dropdown-item">Logout</a>
            </div>
        </div>
        <!-- END User Info-->
    </div>
</div>
<!-- END HEADER --><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/partials/navbar.blade.php ENDPATH**/ ?>