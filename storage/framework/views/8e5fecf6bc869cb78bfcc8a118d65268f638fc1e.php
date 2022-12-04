

<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/dropzone/css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet" type="text/css" media="screen">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->

                <!-- START card -->
                <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('profile.update', $user->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="form-group form-group-default">
                                <label>Full Name</label>
                                <input type="text" value="<?php echo e(old('full_name', $user->full_name)); ?>" name="full_name" class="form-control">
                            </div>
                            
                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label>Gender</label>
                                <select class="full-width" name="gender" data-init-plugin="select2">
                                    <option value="L" <?php echo e(old('gender', $user->gender) == 'L' ? 'selected' : ''); ?>>Men</option>
                                    <option value="P" <?php echo e(old('gender', $user->gender) == 'P' ? 'selected' : ''); ?>>Women</option>
                                </select>
                            </div>

                            <div class="form-group form-group-default">
                                <label>TTL</label>
                                <input type="date" value="<?php echo e(old('full_name', $user->ttl)); ?>" name="ttl" class="form-control">
                            </div>
                            
                            <?php if($user->id == ''): ?>
                                <div class="form-group form-group-default required">
                                    <label>Email</label>
                                    <input type="text" value="<?php echo e(old('email', $user->email)); ?>" name="email" class="form-control" required>
                                </div>
                            <?php endif; ?>

                            <div class="form-group form-group-default">
                                <label>Address</label>
                                <input type="text" value="<?php echo e(old('address', $user->address)); ?>" name="address" class="form-control">
                            </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e($user->id != '' ? 'Update' : 'Save'); ?>

                                </button>
                                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END card -->
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <?php echo $__env->make('dashboard.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/classie/classie.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/jquery-autonumeric/autoNumeric.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/dropzone/dropzone.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-typehead/typeahead.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-typehead/typeahead.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/handlebars/handlebars-v4.0.5.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form_elements.js')); ?>" type="text/javascript"></script>

    <!-- END VENDOR JS -->
    
    <?php if(Session::has('status')): ?>
        <script>
            $(document).ready(function () {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '<?php echo e(Session::get("status")); ?>',
                    position: 'top',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/dashboard/pages/profile/index.blade.php ENDPATH**/ ?>