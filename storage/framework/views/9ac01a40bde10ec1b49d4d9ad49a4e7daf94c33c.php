

<?php $__env->startSection('title', 'Claim'); ?>

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
                            <li class="breadcrumb-item"><a href="#">Self Service</a></li>
                            <li class="breadcrumb-item"><a href="/claim">Claim</a></li>
                            <li class="breadcrumb-item active"><?php echo e($claim->id != '' ? 'Edit' : 'Create'); ?></li>
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
                        <form method="POST" action="<?php echo e($claim->id == '' ? route('claim.store') : route('claim.update', $claim->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($claim->id != ''): ?>
                                <?php echo method_field('patch'); ?>
                            <?php endif; ?>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label>Claim Type</label>
                                <select class="full-width" data-placeholder="Select Type" name="ClaimTypeId" id="ClaimTypeId" data-init-plugin="select2">
                                    <?php $__currentLoopData = $claimType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $claim->ClaimTypeId ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="input-daterange input-group">
                                <input type="date" placeholder="From" class="input-sm form-control" name="start_date" value="<?php echo e($claim->start_date != '' ? \Carbon\carbon::parse(strtotime($claim->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : ''); ?>" required min="2022-01-01" max="2050-01-01" />
                                <div class="input-group-addon">to</div>
                                <input type="date" placeholder="To" class="input-sm form-control" name="end_date" value="<?php echo e($claim->end_date != '' ? \Carbon\carbon::parse(strtotime($claim->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : ''); ?>" required/>
                            </div>

                            <div class="form-group form-group-default mt-3">
                                <label>Description</label>
                                <input type="text" value="<?php echo e(old('description', $claim->description)); ?>" name="description" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Attachment</label>
                                <input type="file" accept="application/pdf" name="attachment" class="form-control">
                            </div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e($claim->id != '' ? 'Update' : 'Save'); ?>

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
        <!-- START CONTAINER FLUID -->
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
    
    <?php if(Session::has('error')): ?>
        <script>
            $(document).ready(function () {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '<?php echo e(Session::get("status")); ?>',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/claim/form.blade.php ENDPATH**/ ?>