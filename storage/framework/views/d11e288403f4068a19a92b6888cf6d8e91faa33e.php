<?php $__env->startSection('title', 'Dashboard'); ?>

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
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class=" container-fluid   container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div class="row">
                    <div class="col-md-4">
                        <!-- START WIDGET widget_weatherWidget-->
                        <div class="widget-17 card  no-border no-margin widget-loader-circle">
                            <div class="card-header ">
                                <div class="card-title">
                                    <i class="pg-icon">calendar</i> Attendances
                                    <span class="caret"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="p-l-5">
                                    <div class="row">
                                        <div class="col-lg-12 col-xlg-6">
                                            <div class="row m-t-10">
                                                <div class="col-lg-5">
                                                    <h4 class="no-margin"><?php echo e(date('l')); ?></h4>
                                                    <p class="small hint-text"><?php echo e(date('d M Y')); ?></p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="d-flex pull-right">
                                                        <canvas height="46" width="46" class="clear-day hint-text"></canvas>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-t-25 p-b-10">
                                                <p class="hint-text">
                                                    Planning Activity
                                                </p>
                                                <p class="pull-left no-margin">
                                                    <?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->planningActivity); ?>

                                                </p>
                                                
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="widget-17-weather b-t b-grey p-t-20">
                                                <div class="weather-info row">
                                                    <div class="col-12 p-r-15">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Clock In</p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    <?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Clock Out</p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    <?php echo e($attendanceStatus == 'Clock In' || $attendanceStatus == 'Clock Out' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Status</p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    <?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->workLoadStatus); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-t-20 timeslot">
                                                <div class="col-lg-12">
                                                    <a href="<?php echo e($attendanceStatus == 'Clock In' ? route('attendance.create') : route('attendance.edit', $attendanceData->id)); ?>" class="btn <?php echo e($attendanceStatus == 'Clock In' ? 'btn-complete' : 'btn-danger'); ?> <?php echo e($attendanceStatus == 'Already Recorded' ? 'd-none' : ''); ?>"><?php echo e($attendanceStatus == 'Clock In' ? 'New Attendance' : $attendanceStatus); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xlg-6 visible-xlg p-l-20">
                                            <div class="row">
                                                <div class="forecast-day col-lg-6 text-center m-t-10 ">
                                                    <div class="bg-contrast-lowest p-b-10 p-t-10">
                                                        <h5 class="p-t-10 no-margin">Tuesday</h5>
                                                        <p class="small hint-text m-b-20">11th Augest 2020</p>
                                                        <canvas class="rain" width="64" height="64"></canvas>
                                                        <h5 class="text-success">29°</h5>
                                                        <p>Feels like rainy </p>
                                                        <p class="small hint-text ">Wind
                                                            <span class="f-13 p-l-20">11km/h</span>
                                                        </p>
                                                        <div class="m-t-20 block">
                                                            <div class="padding-10">
                                                                <div class="row">
                                                                    <div class="col-lg-6 text-center">
                                                                        <p class="hint-text small">Noon</p>
                                                                        <canvas class="sleet" width="25"
                                                                            height="25"></canvas>
                                                                        <p class="text-danger bold">30°C</p>
                                                                    </div>
                                                                    <div class="col-lg-6 text-center">
                                                                        <p class="hint-text small">Night</p>
                                                                        <canvas class="wind" width="25"
                                                                            height="25"></canvas>
                                                                        <p class="text-danger bold">30°C</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-center m-t-10 m-t-10 b-l b-grey b-dashed">
                                                    <div class="bg-contrast-lowest p-b-10 p-t-10">
                                                        <h5 class="p-t-10 no-margin">Wednesday</h5>
                                                        <p class="small hint-text m-b-20">11th Augest 2020</p>
                                                        <canvas class="partly-cloudy-day" width="64" height="64"></canvas>
                                                        <h5 class="text-danger">32°</h5>
                                                        <p>Feels like cloudy </p>
                                                        <p class="hint-text small">Wind
                                                            <span class="f-13 p-l-20">11km/h</span>
                                                        </p>
                                                        <div class="m-t-20 block">
                                                            <div class="padding-10">
                                                                <div class="row">
                                                                    <div class="col-lg-6 text-center">
                                                                        <p class="hint-text small">Noon</p>
                                                                        <canvas class="partly-cloudy-day" width="25"
                                                                            height="25"></canvas>
                                                                        <p class="text-danger bold">30°C</p>
                                                                    </div>
                                                                    <div class="col-lg-6 text-center">
                                                                        <p class="hint-text small">Night</p>
                                                                        <canvas class="wind" width="25"
                                                                            height="25"></canvas>
                                                                        <p class="text-danger bold">30°C</p>
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
                        <!-- END WIDGET -->
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
        <?php echo $__env->make('dashboard.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <?php if(Session::has('status')): ?>
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: 'Login has been successfully.',
                    position: 'top',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    <?php endif; ?>
    
    <script src="assets/js/dashboard.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intranet/public_html/resources/views/dashboard/index.blade.php ENDPATH**/ ?>