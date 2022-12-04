

<?php $__env->startSection('title', 'Task Management'); ?>

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
                            <li class="breadcrumb-item"><a href="#">Task Management</a></li>
                            <li class="breadcrumb-item"><a href="/<?php echo e($task->url); ?>"><?php echo e($task->page); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e($task->id != '' ? 'Edit' : 'Create'); ?></li>
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
                        <form method="POST" action="<?php echo e($task->id != '' ? route($task->route, $task->id) : route($task->route)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if($task->id != ''): ?>
                                <?php echo method_field('patch'); ?>
                            <?php endif; ?>
                            <div class="form-group form-group-default required">
                                <label>Task Name</label>
                                <input type="text" value="<?php echo e(old('name', $task->name)); ?>" name="name" class="form-control" required>
                            </div>
                            
                            <div class="form-group form-group-default mt-3">
                                <label>Description</label>
                                <input type="text" value="<?php echo e(old('description', $task->description)); ?>" name="description" class="form-control">
                            </div>
                            
                            <div class="input-daterange input-group mt-3">
                                <input type="date" placeholder="From" class="input-sm form-control" name="startDate" value="<?php echo e($task->startDate != '' ? \Carbon\carbon::parse(strtotime($task->startDate))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : ''); ?>" required min="2022-01-01" max="2050-01-01" />
                                <div class="input-group-addon">to</div>
                                <input type="date" placeholder="To" class="input-sm form-control" name="endDate" value="<?php echo e($task->endDate != '' ? \Carbon\carbon::parse(strtotime($task->endDate))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : ''); ?>" required/>
                            </div>

                            <?php if($task->page != 'My Task'): ?>
                                <div class="form-group form-group-default form-group-default-select2 required mt-3">
                                    <label class="">Assign To</label>
                                    <select class="full-width" data-placeholder="Select Assigned To" name="assignTo" data-init-plugin="select2">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <optgroup label="<?php echo e($role->name); ?>">
                                            <?php $__currentLoopData = $role->Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($role->id == $user->RoleId): ?>
                                                    <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == old('assignTo', $task->assignTo) ? 'selected' : ''); ?>><?php echo e($user->full_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </optgroup>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <?php if($task->page == 'Member Task'): ?>
                                    <div class="form-group form-group-default required mt-3">
                                        <label>Owner</label>
                                        <input type="text" value="<?php echo e(old('ownerId', $task->ownerId) || $task->url == 'member-task' ? Session::get('full_name') : ''); ?>" name="ownerId" class="form-control" required disabled>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group form-group-default form-group-default-select2 required mt-3">
                                        <label class="">Owner</label>
                                        <select class="full-width" data-placeholder="Select Owner of This Task" name="ownerId" data-init-plugin="select2">
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <optgroup label="<?php echo e($role->name); ?>">
                                                <?php $__currentLoopData = $role->Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($role->id == $user->RoleId): ?>
                                                        <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == old('ownerId', $task->ownerId) ? 'selected' : ''); ?>><?php echo e($user->full_name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                            
                            <div class="form-group form-group-default form-group-default-select2 required mt-3">
                                <label for="priority">Priority</label>
                                <select class="full-width" data-placeholder="Select Priority" name="priority" id="priority" data-init-plugin="select2">
                                    <option value="3" <?php echo e($task->priority == 3 ? 'selected' : ''); ?>>Low</option>
                                    <option value="2" <?php echo e($task->priority == 2 ? 'selected' : ''); ?>>Medium</option>
                                    <option value="1" <?php echo e($task->priority == 1 ? 'selected' : ''); ?>>High</option>
                                </select>
                            </div>
                            
                            <div class="form-group form-group-default form-group-default-select2 required mt-3">
                                <label for="status">Status</label>
                                <select class="full-width" data-placeholder="Select status" name="status" id="status" data-init-plugin="select2">
                                    <option value="Open" <?php echo e($task->status == 'Open' ? 'selected' : ''); ?>>Open</option>
                                    <option value="In Progress" <?php echo e($task->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                                    <option value="Close" <?php echo e($task->status == 'Close' ? 'selected' : ''); ?>>Close</option>
                                    <option value="Cancel" <?php echo e($task->status == 'Cancel' ? 'selected' : ''); ?>>Cancel</option>
                                    <option value="Rescheduled" <?php echo e($task->status == 'Rescheduled' ? 'selected' : ''); ?>>Rescheduled</option>
                                </select>
                            </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e($task->id != '' ? 'Update' : 'Save'); ?>

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
                    message: '<?php echo e(Session::get("error")); ?>',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/dashboard/pages/task-management/form.blade.php ENDPATH**/ ?>