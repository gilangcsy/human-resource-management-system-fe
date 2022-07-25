

<?php $__env->startSection('content'); ?>
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h1 class="semi-bold text-white">
                Meet pages - The simplest and fastest way to build web UI for your dashboard or app.</h1>
            <p class="small">
                Our beautifully-designed UI Framework come with hundreds of customizable features. Every Layout is
                just a starting point. ©2019-2020 All Rights Reserved. Pages® is a registered trademark of Revox
                Ltd.
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-50 p-r-50 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="assets/img/logo-48x48_c.png" alt="logo" data-src="assets/img/logo-48x48_c.png"
                data-src-retina="assets/img/logo-48x48_c@2x.png" width="48" height="48">
            <h2 class="p-t-25">Get Started <br /> with your Dashboard</h2>
            <p class="mw-80 m-t-5">Sign in to your account</p>
            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" action="<?php echo e(route('auth.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label>Login</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Email" class="form-control" required>
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label>Password</label>
                    <div class="controls">
                        <input type="password" class="form-control" name="password" placeholder="Credentials" required>
                    </div>
                </div>
                <!-- START Form Control-->
                <div class="row">
                    <div class="col-md-6 no-padding sm-p-l-10">
                        <div class="form-check">
                            <input type="checkbox" value="1" id="checkbox1">
                            <label for="checkbox1">Remember me</label>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <button aria-label="" class="btn btn-primary btn-lg m-t-10" type="submit">Sign in</button>
                    </div>
                </div>
                <div class="m-b-5 m-t-30">
                    <a href="<?php echo e(route('auth.forgot-password')); ?>" class="normal">Lost your password?</a>
                </div>
                <!-- END Form Control-->
            </form>
            <!--END Login Form-->
            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-9 no-padding m-t-10">
                        <p class="small-text normal hint-text">
                            ©2019-2020 All Rights Reserved. Pages® is a registered trademark of Revox Ltd. <a href="">Cookie
                                Policy</a>, <a href=""> Privacy and Terms</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Right Container-->
    </div>
    <!-- START OVERLAY -->
    <div class="overlay hide" data-pages="search">
        <!-- BEGIN Overlay Content !-->
        <div class="overlay-content has-results m-t-20">
            <!-- BEGIN Overlay Header !-->
            <div class="container-fluid">
                <!-- BEGIN Overlay Logo !-->
                <img class="overlay-brand" src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png"
                    data-src-retina="assets/img/logo_2x.png" width="78" height="22">
                <!-- END Overlay Logo !-->
                <!-- BEGIN Overlay Close !-->
                <a href="#" class="close-icon-light btn-link btn-rounded  overlay-close text-black">
                    <i class="pg-icon">close</i>
                </a>
                <!-- END Overlay Close !-->
            </div>
            <!-- END Overlay Header !-->
            <div class="container-fluid">
                <!-- BEGIN Overlay Controls !-->
                <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Search..."
                    autocomplete="off" spellcheck="false">
                <br>
                <div class="d-flex align-items-center">
                    <div class="form-check right m-b-0">
                        <input id="checkboxn" type="checkbox" value="1">
                        <label for="checkboxn">Search within page</label>
                    </div>
                    <p class="fs-13 hint-text m-l-10 m-b-0">Press enter to search</p>
                </div>
                <!-- END Overlay Controls !-->
            </div>
            <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
            <div class="container-fluid p-t-20">
                <span class="hint-text">
                    suggestions :
                </span>
                <span class="overlay-suggestions"></span>
                <br>
                <div class="search-results m-t-30">
                    <p class="bold">Pages Search Results: <span class="overlay-suggestions"></span></p>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div class="thumbnail-wrapper d48 circular bg-success text-white ">
                                    <img width="36" height="36" src="assets/img/profiles/avatar.jpg"
                                        data-src="assets/img/profiles/avatar.jpg"
                                        data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin "><span class="semi-bold result-name">ice cream</span> on
                                        pages</h5>
                                    <p class="small-text hint-text">via john smith</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div class="thumbnail-wrapper d48 circular bg-success text-white ">
                                    <div>T</div>
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin "><span class="semi-bold result-name">ice cream</span>
                                        related topics</h5>
                                    <p class="small-text hint-text">via pages</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div class="thumbnail-wrapper d48 circular bg-success text-white ">
                                    <div>M
                                    </div>
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin "><span class="semi-bold result-name">ice cream</span>
                                        music</h5>
                                    <p class="small-text hint-text">via pagesmix</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                        </div>
                        <div class="col-md-6">
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div class="thumbnail-wrapper d48 circular bg-info text-white d-flex align-items-center">
                                    <i class="pg-icon">facebook</i>
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin "><span class="semi-bold result-name">ice cream</span> on
                                        facebook</h5>
                                    <p class="small-text hint-text">via facebook</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div
                                    class="thumbnail-wrapper d48 circular bg-complete text-white d-flex align-items-center">
                                    <i class="pg-icon">twitter</i>
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin ">Tweats on<span class="semi-bold result-name"> ice
                                            cream</span></h5>
                                    <p class="small-text hint-text">via twitter</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                            <!-- BEGIN Search Result Item !-->
                            <div class="d-flex m-t-15">
                                <!-- BEGIN Search Result Item Thumbnail !-->
                                <div class="thumbnail-wrapper d48 circular text-white bg-danger d-flex align-items-center">
                                    <i class="pg-icon">google_plus</i>
                                </div>
                                <!-- END Search Result Item Thumbnail !-->
                                <div class="p-l-10">
                                    <h5 class="no-margin ">Circles on<span class="semi-bold result-name"> ice
                                            cream</span></h5>
                                    <p class="small-text hint-text">via google plus</p>
                                </div>
                            </div>
                            <!-- END Search Result Item !-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Overlay Search Results !-->
        </div>
        <!-- END Overlay Content !-->
    </div>
    <!-- END OVERLAY -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php if(Session::has('error')): ?>
    <script>
        $(document).ready(function () {
            // Simple notification having bootstrap's .alert class
            $('.login-container').pgNotification({
                style: 'simple',
                message: '<?php echo e(Session::get("error")); ?>',
                position: 'top-right',
                timeout: 4000,
                type: 'danger'
            }).show();
        });
    </script>
<?php endif; ?>

<?php if(Session::has('status')): ?>
    <script>
        $(document).ready(function () {
            // Simple notification having bootstrap's .alert class
            $('.login-container').pgNotification({
                style: 'simple',
                message: '<?php echo e(Session::get("status")); ?>',
                position: 'top-right',
                timeout: 4000,
                type: 'success'
            }).show();
        });
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/auth/index.blade.php ENDPATH**/ ?>