

<?php $__env->startSection('title', 'My Attendance'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/dropzone/css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet" type="text/css" media="screen">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"  
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
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
                            <li class="breadcrumb-item"><a href="/attendance">My Attendance</a></li>
                            <li class="breadcrumb-item active"><?php echo e($attendanceData->id != '' ? 'Edit' : 'Create'); ?></li>
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
                        <form method="POST" action="<?php echo e($attendanceData->id == '' ? route('attendance.store') : route('attendance.update', $attendanceData->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($attendanceData->id != ''): ?>
                                <?php echo method_field('patch'); ?>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group form-group-default required">
                                        <label>Employee ID</label>
                                        <input type="text" value="<?php echo e(Session::get('employee_id')); ?>" name="employee_id"
                                            class="form-control" required readonly>
                                    </div>

                                    <div class="form-group form-group-default required">
                                        <label>Full Name</label>
                                        <input type="text" value="<?php echo e(Session::get('full_name')); ?>" name="full_name"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group form-group-default">
                                        <label>Clock In</label>
                                        <input type="text"
                                            value="<?php echo e($attendanceData->clockIn != ''? \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y - H:i'): ''); ?>"
                                            name="clockIn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group text-center">
                                        <img alt="clock in selfie" width="200" src="<?php echo e($attendanceData->clock_in_photo == '' ? asset('assets/img/profiles/default.jpg') : $url_storage . '/attachment/attendances/clockIn/' . $attendanceData->clock_in_photo); ?>" width="350" height="350" class=" mr-1 img-thumbnail img-fluid">
                                    </div>

                                    <div class="form-group form-group-default">
                                        <label>Clock Out</label>
                                        <input type="text"
                                            value="<?php echo e($attendanceData->clockOut != ''? \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y - H:i'): ''); ?>"
                                            name="clockOut" class="form-control" readonly>
                                    </div>

                                    <div class="form-group text-center">
                                        <img alt="clock out selfie" width="200" src="<?php echo e($attendanceData->clock_out_photo == '' ? asset('assets/img/profiles/default.jpg') : $url_storage . '/attachment/attendances/clockOut/' . $attendanceData->clock_out_photo); ?>" width="350" height="350" class=" mr-1 img-thumbnail img-fluid">
                                    </div>

                                    <div class="form-group form-group-default form-group-default-select2 required">
                                        <label>Work Load Status</label>
                                        <select class="full-width" data-placeholder="Select Type" id="workload_status" name="workload_status"
                                            data-init-plugin="select2">
                                            <option value="Available"
                                                <?php echo e($attendanceData->workload_status == 'Available' ? 'selected' : ''); ?>>
                                                Available
                                            </option>
                                            <option value="Moderate"
                                                <?php echo e($attendanceData->workload_status == 'Moderate' ? 'selected' : ''); ?>>
                                                Moderate
                                            </option>
                                            <option value="Busy"
                                                <?php echo e($attendanceData->workload_status == 'Busy' ? 'selected' : ''); ?>>
                                                Busy
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group form-group-default required">
                                        <label>Planning Activity</label>
                                        <input type="text" value="<?php echo e($attendanceData->planning_activity); ?>"
                                            name="planning_activity" id="planning_activity" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-group-default required">
                                        <video id="webcam" autoplay playsinline class="w-100 h-100"></video>
                                        <canvas id="canvas" style="display: none"></canvas>
                                        <div class="col-12 text-center mt-3">
                                            <a href="#" id="download" class="align-center" download
                                                onclick="take()">Take</a>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Upload Selfie</label>
                                        <input type="file" accept="image/*" name="photo" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group form-group-default required">
                                        <label>Address</label>
                                        <input type="text" name="location" value="<?php echo e($attendanceData->location); ?>" id="location"
                                        class="form-control" autofocus autocomplete="off" required readonly>
                                    </div>
                                    
                                    <div class="form-group form-group-default required">
                                        <label>Latitude</label>
                                        <input type="text" value="<?php echo e($attendanceData->latitude); ?>" id="latitude" name="latitude" class="form-control" required readonly>
                                    </div>
                                    
                                    <div class="form-group form-group-default required">
                                        <label>Longitude</label>
                                        <input type="text" value="<?php echo e($attendanceData->longitude); ?>" id="longitude" name="longitude" class="form-control" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <div id="map" style="height: 500px;"></div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <?php if($attendanceStatus != 'Clock In'): ?>
                                            <button type="button" onclick="update()" class="btn btn-complete">
                                                Update
                                            </button>
                                        <?php endif; ?>

                                        <button type="submit" class="btn <?php echo e($attendanceStatus == 'Clock In' ? 'btn-complete' : 'btn-danger'); ?> <?php echo e($attendanceStatus == 'Already Recorded' ? 'd-none' : ''); ?>">
                                            <?php echo e($attendanceStatus); ?>

                                        </button>
                                        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-complete">
                                            Back
                                        </a>
                                    </div>
                                </div>
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
                    message: "<?php echo e(Session::get('error')); ?>",
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    <?php endif; ?>

    <script>
        let longitude = document.getElementById('longitude');
        let latitude = document.getElementById('latitude');
        let address = document.getElementById('location');
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            console.log(position.coords.latitude + ' ' + position.coords.longitude)
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            if (`<?php echo e($attendanceStatus); ?>` != 'Already Recorded') {
                L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
                    .bindPopup('This is where I Am :D')
                    .openPopup();
                latitude.value = position.coords.latitude
                longitude.value = position.coords.longitude

                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.coords.latitude}&lon=${position.coords.longitude}`,
                    function(data) {
                        address.value = data.display_name
                    });
            } else {
                L.marker([latitude.value, longitude.value]).addTo(map)
                    .bindPopup('This is where I Am!! :D')
                    .openPopup();
            }
        }
        getLocation()
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const webcam = new Webcam(webcamElement, 'user', canvasElement);
        webcam.start();

        function take() {
            let picture = webcam.snap();
            document.querySelector('#download').href = picture;
        }

        function update() {
            let planning_activity = document.getElementById('planning_activity');
            let choice = document.getElementById('workload_status');
            let choiceText = choice.options[choice.selectedIndex].innerHTML
            let formData = {
                planning_activity: planning_activity.value,
                workload_status: choiceText,
                updatedBy: `<?php echo e(Session::get('userId')); ?>`
            }
            $.ajax({
                url: `<?php echo e($url); ?>attendances/<?php echo e($id); ?>`,
                type: "PATCH",
                dataType: "json",
                data: formData,
                success: function(data) {
                    window.location.href = "<?php echo e(route('dashboard.index')); ?>"
                },
            })
        }
    </script>

    <!-- Adding a script for dropzone -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.partials.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/dashboard/pages/my-attendance/form.blade.php ENDPATH**/ ?>