

<?php $__env->startSection('title', 'News'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/dropzone/css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>" rel="stylesheet" type="text/css"
        media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet"
        type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet"
        type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/css/wysiwyg.scss')); ?>" rel="stylesheet" type="text/css">
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
                            <li class="breadcrumb-item"><a href="#">News</a></li>
                            <li class="breadcrumb-item active"><?php echo e($news->id != '' ? 'Edit' : 'Create'); ?></li>
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
                        <form method="POST" action="<?php echo e($news->id == '' ? route('news.store') : route('news.update', $news->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($news->id != ''): ?>
                                <?php echo method_field('patch'); ?>
                            <?php endif; ?>
                            <div class="form-group form-group-default required">
                                <label>Title</label>
                                <input type="text" value="<?php echo e(old('title', $news->title)); ?>" name="title"
                                    class="form-control" required>
                            </div>
                            
                            <div class="form-group form-group-default">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control"><?php echo e($news->content); ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Thumbnail</label>
                                <input type="file" accept="image/png,jpeg,jpg" name="thumbnail" class="form-control"
                                    multiple>
                            </div>

                            <?php if($news->id != ''): ?>
                                <img src="<?php echo e($urlStorage . '/images/news/' . $news->thumbnail); ?>" alt="thumbnail" class="img-thumbnail" width="120">
                            <?php endif; ?>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e($news->id != '' ? 'Update' : 'Save'); ?>

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
    <script src="<?php echo e(asset('assets/js/wysiwyg.js')); ?>" type="text/javascript"></script>

    <script>
        
        $('#editor').wysiwyg({
  toolbar: [
    ['mode'],
    ['operations', ['undo', 'rendo', 'cut', 'copy', 'paste']],
    ['styles'],
    ['fonts', ['select', 'size']],
    ['text', ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'font-color', 'bg-color']],
    ['align', ['left', 'center', 'right', 'justify']],
    ['lists', ['unordered', 'ordered', 'indent', 'outdent']],
    ['components', ['table', /*'chart'*/]],
    ['intervals', ['line-height', 'letter-spacing']],
    ['insert', ['emoji', 'link', 'image', '<a href="https://www.jqueryscript.net/tags.php?/video/">video</a>', 'symbol', /*'bookmark'*/]],
    ['special', ['print', 'unformat', 'visual', 'clean']],
    /*['fullscreen'],*/
  ],
});
    </script>


    <!-- END VENDOR JS -->

    <?php if(Session::has('error')): ?>
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '<?php echo e(Session::get('status')); ?>',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/pages/news/form.blade.php ENDPATH**/ ?>