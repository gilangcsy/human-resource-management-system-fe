

<?php $__env->startSection('title', 'Claim'); ?>

<?php $__env->startSection('css'); ?>
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css"
        rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="assets/css/style.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class=" container-fluid  container-fixed-lg sm-p-l-0 sm-p-r-0">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Self Service</a></li>
                            <li class="breadcrumb-item active">Claim</li>
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
                        <div class="card-title">
                            <form action="<?php echo e(route('claim.create')); ?>">
                                <button class="btn btn-primary">
                                    <i class="pg-icon">plus</i>
                                    Add New Claim
                                </button>
                            </form>
                        </div>
                        <div class="pull-right">
                            <div class="col-xs-12">
                                <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $__currentLoopData = $claim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <b><?php echo e($item->requester_emp_id); ?></b>
                                            <br>
                                            <?php echo e($item->requester_name); ?>

                                        </td>
                                        
                                        <td>
                                            <?php echo e(\Carbon\carbon::parse(strtotime($item->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y')); ?> - <?php echo e(\Carbon\carbon::parse(strtotime($item->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y')); ?></td>
                                        <td><?php echo e($item->description); ?></td>
                                        <td>
                                            <?php if($item->attachment != null): ?>
                                                <a href="<?php echo e($download_url . $item->attachment); ?>">
                                                    <?php echo e($item->attachment); ?>

                                                </a>
                                            <?php else: ?>
                                                No Attachment.
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                                $badge = 'badge-warning';
                                                if($item->last_status == 'Approved') {
                                                    $badge = 'badge-success';
                                                } else if($item->last_status == 'Rejected') {
                                                    $badge = 'badge-danger';
                                                }
                                            ?>
                                            <span class="badge <?php echo e($badge); ?>"><?php echo e($item->last_status); ?></span>
                                            </td>
                                        <td>
                                            <div class="d-flex">
                                                <?php if($item->approval_one_status != 'Approved' AND $item->approval_one_status != 'Rejected'): ?>
                                                    <a href="<?php echo e(route('claim.edit', $item->id)); ?>" class="btn btn-md btn-warning">
                                                        <i class="pg-icon">edit</i>
                                                    </a>
                                                    <form action="<?php echo e(route('claim.destroy', $item->id)); ?>" method="POST">
                                                        <?php echo method_field('delete'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <button class="btn btn-md btn-danger ml-2" onclick="return confirm('Are you sure?')">
                                                            <i class="pg-icon">trash</i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('claim.show', $item->id)); ?>" class="btn btn-md btn-primary ml-2">
                                                    <i class="pg-icon">eye</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <script src="assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js"
        type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/datatables.js" type="text/javascript"></script>
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

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/claim/index.blade.php ENDPATH**/ ?>