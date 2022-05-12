

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/modules/izitoast/css/iziToast.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <input type="hidden" id="status" value="<?php echo e(Session::get('status')); ?>">

    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Today Attendance
                                
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"><?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')); ?></div>
                                    <div class="card-stats-item-label">Clock In</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"><?php echo e($attendanceStatus == 'Clock In' || $attendanceStatus == 'Clock Out' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')); ?></div>
                                    <div class="card-stats-item-label">Clock Out</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"><?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->workLoadStatus); ?></div>
                                    <div class="card-stats-item-label">Status</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Planning Activity</h4>
                            </div>
                            <div class="card-body" style="font-size:12pt">
                                <?php echo e($attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->planningActivity); ?>

                            </div>
                            <div class="card-footer mt-2">
                                <a href="<?php echo e($attendanceStatus == 'Clock In' ? route('attendance.create') : route('attendance.edit', $attendanceData->id)); ?>" class="btn <?php echo e($attendanceStatus == 'Clock In' ? 'btn-primary' : 'btn-danger'); ?> <?php echo e($attendanceStatus == 'Already Recorded' ? 'd-none' : ''); ?>"><?php echo e($attendanceStatus == 'Clock In' ? 'New Attendance' : $attendanceStatus); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <!-- JS Libraies -->
    <script src="<?php echo e(asset('assets/modules/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/modules/izitoast/js/iziToast.min.js')); ?>"></script>

    <?php if(Session::has('status')): ?>
        <script>
            let status = document.getElementById("status").value;
            iziToast.success({
                title: `Success.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('active.dashboard'); ?>
    active
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/dashboard/index.blade.php ENDPATH**/ ?>