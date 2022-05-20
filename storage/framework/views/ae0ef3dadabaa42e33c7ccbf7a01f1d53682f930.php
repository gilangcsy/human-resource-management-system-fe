

<?php $__env->startSection('title', 'Access Rights'); ?>

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
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">Access Rights</li>
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
                                    <th>
                                        No.
                                    </th>
                                    <th>Name</th>
                                    <th>Create</th>
                                    <th>Read</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th></th>
                                </tr>
                            </thead>

                            
                            <tbody>
                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $allowCreate = '';
                                        $allowRead = '';
                                        $allowUpdate = '';
                                        $allowDelete = '';
                                        $isExists = '';
                                        $checkedAll = '';
                                    ?>
                                    <?php $__currentLoopData = $accessRights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            if ($item_menu->id == $item->menu_id) {
                                                $allowCreate = $item->allow_create;
                                                $allowRead = $item->allow_read;
                                                $allowDelete = $item->allow_delete;
                                                $allowUpdate = $item->allow_update;
                                                $isExists = $item->id;
                                            }
                                            
                                            if ($allowCreate && $allowRead && $allowUpdate && $allowDelete == true) {
                                                $checkedAll = true;
                                            }
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <b><?php echo e($item_menu->master_menu_name); ?></b>
                                            <br>
                                            <?php echo e($item_menu->name); ?>

                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg complete">
                                                <input type="checkbox" class="checkbox-action" data-user="<?php echo e($item->id); ?>" id="switch-create<?php echo e($loop->iteration); ?>" <?php echo e($allowCreate == true ? 'checked' : ''); ?> data-menu="<?php echo e($item_menu->id); ?>" data-role-menu="<?php echo e($isExists); ?>" data-action="create">
                                                <label for="switch-create<?php echo e($loop->iteration); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg complete">
                                                <input type="checkbox" class="checkbox-action" data-user="<?php echo e($item->id); ?>" id="switch-read<?php echo e($loop->iteration); ?>" <?php echo e($allowRead == true ? 'checked' : ''); ?> data-menu="<?php echo e($item_menu->id); ?>" data-role-menu="<?php echo e($isExists); ?>" data-action="read">
                                                <label for="switch-read<?php echo e($loop->iteration); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg complete">
                                                <input type="checkbox" class="checkbox-action" data-user="<?php echo e($item->id); ?>" id="switch-update<?php echo e($loop->iteration); ?>" <?php echo e($allowUpdate == true ? 'checked' : ''); ?> data-menu="<?php echo e($item_menu->id); ?>" data-role-menu="<?php echo e($isExists); ?>" data-action="update">
                                                <label for="switch-update<?php echo e($loop->iteration); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg complete">
                                                <input type="checkbox" class="checkbox-action" data-user="<?php echo e($item->id); ?>" id="switch-delete<?php echo e($loop->iteration); ?>" <?php echo e($allowDelete == true ? 'checked' : ''); ?> data-menu="<?php echo e($item_menu->id); ?>" data-role-menu="<?php echo e($isExists); ?>" data-action="delete">
                                                <label for="switch-delete<?php echo e($loop->iteration); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg complete">
                                                <input type="checkbox" class="checked-all" data-user="<?php echo e($item->id); ?>" id="switch-checked<?php echo e($loop->iteration); ?>" <?php echo e($checkedAll ? 'checked' : ''); ?> data-menu="<?php echo e($item_menu->id); ?>" data-role-menu="<?php echo e($isExists); ?>" data-action="check-all">
                                                <label for="switch-checked<?php echo e($loop->iteration); ?>"></label>
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

        <?php echo $__env->make('dashboard.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '<?php echo e(Session::get('status')); ?>',
                    position: 'top',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    <?php endif; ?>

    <script>
        $('#tableWithSearch tbody').on('click', '.checked-all', function () {
            let data
            let role_menu_id = $(this).attr('data-role-menu')
            let action = $(this).attr('data-action')
            let data_menu = $(this).attr('data-menu')
            if (!$(this).is(':checked')) {
                // do something if the checkbox is NOT checked
                data = {
                    allow_create: false,
                    allow_read:  false ,
                    allow_update: false,
                    allow_delete: false,
                    allow_view: false,
                    updatedBy: "<?php echo e(session()->get('userId')); ?>"
                }
                updateRoleMenu(data, role_menu_id)
            } else {
                data = {
                    allow_create: true,
                    allow_read: true,
                    allow_update:  true,
                    allow_delete: true,
                    allow_view: true,
                    createdBy: "<?php echo e(session()->get('userId')); ?>",
                    updatedBy: "<?php echo e(session()->get('userId')); ?>",
                    RoleId: '<?php echo e($role->id); ?>',
                    MenuId: data_menu
                }
                role_menu_id == '' ? assignRoleMenu(data) : updateRoleMenu(data, role_menu_id)
            }
        })

        $('#tableWithSearch tbody').on('click', '.checkbox-action', function() {
            let data
            let role_menu_id = $(this).attr('data-role-menu')
            let action = $(this).attr('data-action')
            let data_menu = $(this).attr('data-menu')
            if(role_menu_id == '') {
                data = {
                    RoleId: '<?php echo e($role->id); ?>',
                    allow_create: action == 'create' ? true : false,
                    allow_read: action == 'read' ? true : false,
                    allow_update: action == 'update' ? true : false,
                    allow_delete: action == 'delete' ? true : false,
                    allow_view: action == 'view' ? true : false,
                    MenuId: data_menu,
                    createdBy: "<?php echo e(session()->get('userId')); ?>"
                }
                assignRoleMenu(data)
            } else {
                if(action == 'create') {
                    data = {
                        allow_create: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'read') {
                    data = {
                        allow_read: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'update') {
                    data = {
                        allow_update: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'delete') {
                    data = {
                        allow_delete: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'view') {
                    data = {
                        allow_view: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                }
                data.updatedBy = "<?php echo e(session()->get('userId')); ?>"
                updateRoleMenu(data, role_menu_id)
            }
        })

        function assignRoleMenu(data) {
            $.ajax({
                url: `<?php echo e($base_url); ?>accessRights`,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    location.reload()
                },
            });
        }
        
        function updateRoleMenu(data, id) {
            $.ajax({
                url: `<?php echo e($base_url); ?>accessRights/${id}`,
                type: 'PATCH',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    location.reload()
                },
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/access-rights/form.blade.php ENDPATH**/ ?>