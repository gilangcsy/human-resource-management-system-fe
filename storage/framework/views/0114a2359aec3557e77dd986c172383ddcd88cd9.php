

<?php $__env->startSection('title', 'Menu Position'); ?>

<?php $__env->startSection('css'); ?>
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" media="screen" />
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

                <!-- START card -->
                <div class="card card-default">
                    <div class="card-header ">
                        <div class="card-title">
                            Menu
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="cf nestable-lists">
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($list['childs']): ?>
                                            <li class="dd-item" data-id="<?php echo e($list['id']); ?>" data-menu="<?php echo e($list['name']); ?>" data-position="<?php echo e($list['position']); ?>">
                                                <div class="dd-handle">
                                                    <?php echo e($list['name']); ?>

                                                </div>
                                                <ol class="dd-list">
                                                    <?php $__currentLoopData = $list['childs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="dd-item" data-id="<?php echo e($child['id']); ?>" data-menu="<?php echo e($child['name']); ?>" data-position="<?php echo e($child['position']); ?>">
                                                            <div class="dd-handle">
                                                                <?php echo e($child['name']); ?>

                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ol>
                                            </li>
                                        <?php else: ?>
                                            <li class="dd-item" data-id="<?php echo e($list['id']); ?>" data-menu="<?php echo e($list['name']); ?>" data-position="<?php echo e($list['position']); ?>">
                                                <div class="dd-handle">
                                                    <?php echo e($list['name']); ?>

                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                            </div>
                            <div class="clearfix"></div>
                        </div>
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
    <script src="assets/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/datatables.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->


    <script>
        $(document).ready(function() {
            let refresh = 0
            let updateOutput = function(e) {
                refresh++
                let list = e.length ? e : $(e.target),
                    output = list.data('output')
                if (window.JSON) {
                    output.html(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                    // console.log(list.nestable('serialize'))
                } else {
                    output.html('JSON browser support required for this demo.');
                }

                let data = list.nestable('serialize')
                let master = []
                let children = []
                let allData = {}
                data.forEach((item, index) => {
                    let newPosition = index + 1
                    if(item.children != undefined) {
                        let masterMenu = item.id
                        item.children.forEach((item, index) => {
                            let newPositionC = index + 1
                            master.push([item.id, newPositionC, masterMenu])
                        })
                        master.push([item.id, newPosition, 0 ])
                    } else {
                        master.push([item.id, newPosition, 0 ])
                    }
                })

                allData.master = master

                if (refresh != 1) {
                    $.ajax({
                        url: '<?php echo e($base_url); ?>master/menu/newPositions',
                        method: 'POST',
                        dataType: 'TEXT',
                        data: {
                            positions: allData.master,
                            updatedBy: '<?php echo e(Session::get("userId")); ?>'
                        }, success: function (response) {
                            location.reload()
                        }
                    })
                }
            };
            $('#nestable').nestable({
                maxDepth: 2,
                group: 1
            }).on('change', updateOutput)

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')))

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/menu-position/index.blade.php ENDPATH**/ ?>