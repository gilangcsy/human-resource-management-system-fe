

<?php $__env->startSection('title', 'Claim Detail'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/plugins/pace/pace-theme-flash.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('https://fonts.googleapis.com/icon?family=Material+Icons')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo e(asset('assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/datatables-responsive/css/datatables.responsive.css')); ?>" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="<?php echo e(asset('pages/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">Detail</li>
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
                <div class="card card-transparent">
                    <div class="card-header">
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Approver Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><?php echo e($claim->approver_one_name); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($claim->approval_one_status == 'Approved' ? 'badge-success' : ($claim->approval_one_status == 'Rejected' ? 'badge-danger' : 'badge-warning')); ?>"><?php echo e($claim->approval_one_status); ?></span>
                                    </td>
                                </tr>
                                <?php if($claim->approver_two != null): ?>
                                    <tr>
                                        <td>2</td>
                                        <td><?php echo e($claim->approver_two_name); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($claim->approval_two_status == 'Approved' ? 'badge-success' : ($claim->approval_two_status == 'Rejected' ? 'badge-danger' : 'badge-warning')); ?>"><?php echo e($claim->approval_two_status); ?></span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($claim->approver_three != null): ?>
                                    <tr>
                                        <td>3</td>
                                        <td><?php echo e($claim->approver_three_name); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($claim->approval_three_status == 'Approved' ? 'badge-success' : ($claim->approval_three_status == 'Rejected' ? 'badge-danger' : 'badge-warning')); ?>"><?php echo e($claim->approval_three_status); ?></span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
    <script src="<?php echo e(asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')); ?>" type="text/javascript">
    </script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/datatables-responsive/js/datatables.responsive.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/datatables-responsive/js/lodash.min.js')); ?>"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo e(asset('assets/js/datatables.js')); ?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->

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


<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/claim/detail.blade.php ENDPATH**/ ?>