

<?php $__env->startSection('title', 'Claim Report'); ?>

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

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
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
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
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
                        <div class="pull-left no-gutters">
                            <div class="col-12">
                                <label for="min">Start</label>
                                <input type="date" id="min" class="form-control pull-left">
                            </div>
                        </div>
                        <div class="pull-left">
                            <div class="col-12">
                                <label for="max">End</label>
                                <input type="date" id="max" class="form-control pull-left">
                            </div>
                        </div>
                        <div class="pull-left">
                            <div class="col-12">
                                <label for="category">Range Category</label>
                                <select name="category" class="category form-control pull-left" id="">
                                    <option value="6">Submission</option>
                                    <option value="4">Claim Start</option>
                                    <option value="5">Claim End</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="tableTest">
                            <thead>
                                <tr>
                                    <th> No.</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Desription</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Submission Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $__currentLoopData = $claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <?php echo e($item->requester_emp_id); ?>

                                        </td>
                                        <td><?php echo e($item->requester_name); ?></td>
                                        <td><?php echo e($item->description); ?></td>
                                        <td><?php echo e($item->start_date != null ? \Carbon\carbon::parse(strtotime($item->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : 'N/A'); ?></td>
                                        <td><?php echo e($item->end_date != null ? \Carbon\carbon::parse(strtotime($item->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : 'N/A'); ?></td>
                                        <td><?php echo e($item->submission_date != null ? \Carbon\carbon::parse(strtotime($item->submission_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : 'N/A'); ?></td>
                                        
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
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> No.</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Desription</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Submission Date</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
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
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    
    
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/custom-datatables.js" type="text/javascript"></script>
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

    <script>
        let rangePosition = 6
        let claimPosition = [0, 1, 2, 3, 4, 5, 6, 7]
        $('select.category').on('change', function() {
            rangePosition = this.value
            datatableWithRange(rangePosition, claimPosition)
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/reporting-claim/index.blade.php ENDPATH**/ ?>