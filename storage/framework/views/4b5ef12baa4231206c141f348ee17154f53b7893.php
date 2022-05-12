

<?php $__env->startSection('title', 'Menu Management'); ?>

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
                <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">Portlet Tools
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div data-pages="card" class="card card-default" id="card-basic">
                                            <div class="card-header">
                                                <div class="card-title">Portlet Title
                                                </div>
                                                <div class="card-controls">
                                                    <ul>
                                                        <li><a data-toggle="collapse" class="card-collapse" href="#"><i
                                                                    class="card-icon card-icon-collapse"></i></a>
                                                        </li>
                                                        <li><a data-toggle="refresh" class="card-refresh" href="#"><i
                                                                    class="card-icon card-icon-refresh"></i></a>
                                                        </li>
                                                        <li><a data-toggle="close" class="card-close" href="#"><i
                                                                    class="card-icon card-icon-close"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card card-transparent">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div data-pages="card" class="card card-default" id="card-basic">
                                                                    <div class="card-header">
                                                                        <div class="card-title">Portlet Title
                                                                        </div>
                                                                        <div class="card-controls">
                                                                            <ul>
                                                                                <li><a data-toggle="collapse" class="card-collapse" href="#"><i
                                                                                            class="card-icon card-icon-collapse"></i></a>
                                                                                </li>
                                                                                <li><a data-toggle="refresh" class="card-refresh" href="#"><i
                                                                                            class="card-icon card-icon-refresh"></i></a>
                                                                                </li>
                                                                                <li><a data-toggle="close" class="card-close" href="#"><i
                                                                                            class="card-icon card-icon-close"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small-text no-margin pull-left sm-pull-reset">
                    ©2014-2020 All Rights Reserved. Pages® and/or its subsidiaries or affiliates are registered
                    trademark of Revox Ltd.
                    <span class="hint-text m-l-15">Pages v05.23 20201105.r.190</span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    Hand-crafted <span class="hint-text">&amp; made with Love</span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php if(Session::has('status')): ?>
        <script>
            let status = document.getElementById('status').value
            iziToast.success({
                title: `Menu Management.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Menu Management.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    <?php endif; ?>

    <script>
        $('#tableWithSearch tbody').sortable({
            handle: '.semi-bold',
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('updated')
                    }
                })
                saveNewPositions();
            }
        })

        $(".sortable-table-custom").dataTable({
            "dom": 'frtip',
            "columnDefs": [{
                "sortable": false,
                "targets": [0]
            }]
        })

        function saveNewPositions() {
            let positions = []
            $('.updated').each(function() {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')])
                $(this).removeClass('updated')
            })

            $.ajax({
                url: '<?php echo e($base_url); ?>master/menu/newPositions',
                method: 'POST',
                dataType: 'TEXT',
                data: {
                    positions: positions
                },
                success: function(response) {
                    location.reload()
                }
            })
        }
    </script>

    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('active.menu'); ?>
    active
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/menu/index.blade.php ENDPATH**/ ?>