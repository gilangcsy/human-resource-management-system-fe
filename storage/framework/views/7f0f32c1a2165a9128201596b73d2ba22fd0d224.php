

<?php $__env->startSection('title', 'Leave'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css"
        media="screen" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/dropzone/css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>" rel="stylesheet" type="text/css"
        media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet"
        type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet"
        type="text/css" media="screen">
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
                            <li class="breadcrumb-item"><a href="/leave">Leave</a></li>
                            <li class="breadcrumb-item active"><?php echo e($leave->id != '' ? 'Edit' : 'Create'); ?></li>
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
                        <form method="POST"
                            action="<?php echo e($leave->id == '' ? route('leave.store') : route('leave.update', $leave->id)); ?>"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($leave->id != ''): ?>
                                <?php echo method_field('patch'); ?>
                            <?php endif; ?>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label>Leave Type</label>
                                <select class="full-width" data-placeholder="Select Type" name="LeaveTypeId"
                                    id="LeaveTypeId" data-init-plugin="select2">
                                    <?php $__currentLoopData = $leaveType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e($item->id == $leave->LeaveTypeId ? 'selected' : ''); ?>><?php echo e($item->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="input-daterange input-group">
                                <input type="date" placeholder="From" class="input-sm form-control" name="start_date"
                                    value="<?php echo e($leave->start_date != ''? \Carbon\carbon::parse(strtotime($leave->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d'): ''); ?>"
                                    required min="2022-01-01" max="2050-01-01" />
                                <div class="input-group-addon">to</div>
                                <input type="date" placeholder="To" class="input-sm form-control" name="end_date"
                                    value="<?php echo e($leave->end_date != ''? \Carbon\carbon::parse(strtotime($leave->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d'): ''); ?>"
                                    required />
                            </div>

                            <div class="form-group form-group-default mt-3">
                                <label>Description</label>
                                <input type="text" value="<?php echo e(old('description', $leave->description)); ?>"
                                    name="description" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Attachment</label>
                                <input type="file" accept="application/pdf" name="attachment[]" class="form-control"
                                    multiple>
                            </div>
                            <?php if($leave->attachment != null): ?>
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">Attachment
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <div class="card card-default">
                                                <div class="card-body">
                                                    <?php
                                                        $attachment = $leave->attachment;
                                                        $jml = count($attachment) - 1;
                                                        for ($i = 0; $i <= $jml; $i++) { ?>
                                                            <a href="<?php echo e($download_url . $attachment[$i]); ?>" class="btn btn-default btn-xs mt-2">
                                                                <?php echo e($attachment[$i]); ?>

                                                            </a>
                                                            <a href="#" data-attach="<?php echo e($attachment[$i]); ?>" class="btn btn-danger btn-xs mt-2 remove-attach" onclick="return confirm('Are you sure?')">
                                                                <span class="pg-icon">trash</span>
                                                            </a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e($leave->id != '' ? 'Update' : 'Save'); ?>

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
    <script src="<?php echo e(asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js')); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')); ?>" type="text/javascript">
    </script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>" type="text/javascript">
    </script>
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
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: "<?php echo e(Session::get('status')); ?>",
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    <?php endif; ?>
    <?php if($leave->id != ''): ?>
        <script>
            $('.remove-attach').on('click', function () {
                let attachmentFile = $(this).attr('data-attach')

                let attachmentData = {
                    leaveId: '<?php echo e($leave->id); ?>',
                    attachment: attachmentFile
                }

                $.ajax({
                        url: `<?php echo e($url); ?>leaves/attachment/remove`,
                        type: 'DELETE',
                        dataType: 'JSON',
                        headers: {
                            'x-access-token':"<?php echo e(Session::get('token')); ?>"
                        },
                        data: attachmentData,
                        success: function(data) {
                            location.reload()
                        },
                    })
            })
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/dashboard/pages/leave/form.blade.php ENDPATH**/ ?>