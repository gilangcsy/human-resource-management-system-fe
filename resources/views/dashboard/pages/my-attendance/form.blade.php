@extends('dashboard.partials.app')

@section('title', 'My Attendance')

@section('css')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" media="screen">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"  
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
@endsection

@section('page-content')
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
                            <li class="breadcrumb-item active">{{ $attendanceData->id != '' ? 'Edit' : 'Create' }}</li>
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
                        <form method="POST" action="{{ $attendanceData->id == '' ? route('attendance.store') : route('attendance.update', $attendanceData->id) }}" enctype="multipart/form-data">
                            @csrf
                            @if ($attendanceData->id != '')
                                @method('patch')
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group form-group-default required">
                                        <label>Employee ID</label>
                                        <input type="text" value="{{ Session::get('employee_id') }}" name="employee_id"
                                            class="form-control" required readonly>
                                    </div>

                                    <div class="form-group form-group-default required">
                                        <label>Full Name</label>
                                        <input type="text" value="{{ Session::get('full_name') }}" name="full_name"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group form-group-default">
                                        <label>Clock In</label>
                                        <input type="text"
                                            value="{{ $attendanceData->clockIn != ''? \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y - H:i'): '' }}"
                                            name="clockIn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group text-center">
                                        <img alt="clock in selfie" width="200" src="{{ $attendanceData->clockInPhoto == '' ? asset('assets/img/profiles/default.jpg') : $url_storage . 'storage/attachment/attendances/clockIn/' . $attendanceData->clockInPhoto}}" width="350" height="350" class=" mr-1 img-thumbnail img-fluid">
                                    </div>

                                    <div class="form-group form-group-default">
                                        <label>Clock Out</label>
                                        <input type="text"
                                            value="{{ $attendanceData->clockOut != ''? \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y - H:i'): '' }}"
                                            name="clockOut" class="form-control" readonly>
                                    </div>

                                    <div class="form-group text-center">
                                        <img alt="clock out selfie" width="200" src="{{ $attendanceData->clockOutPhoto == '' ? asset('assets/img/profiles/default.jpg') : $url_storage . 'storage/attachment/attendances/clockOut/' . $attendanceData->clockOutPhoto}}" width="350" height="350" class=" mr-1 img-thumbnail img-fluid">
                                    </div>

                                    <div class="form-group form-group-default form-group-default-select2 required">
                                        <label>Work Load Status</label>
                                        <select class="full-width" data-placeholder="Select Type" id="workLoadStatus" name="workLoadStatus"
                                            data-init-plugin="select2">
                                            <option value="Available"
                                                {{ $attendanceData->workLoadStatus == 'Available' ? 'selected' : '' }}>
                                                Available
                                            </option>
                                            <option value="Moderate"
                                                {{ $attendanceData->workLoadStatus == 'Moderate' ? 'selected' : '' }}>
                                                Moderate
                                            </option>
                                            <option value="Busy"
                                                {{ $attendanceData->workLoadStatus == 'Busy' ? 'selected' : '' }}>
                                                Busy
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group form-group-default required">
                                        <label>Planning Activity</label>
                                        <input type="text" value="{{ $attendanceData->planningActivity }}"
                                            name="planningActivity" id="planningActivity" class="form-control" required>
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
                                        <input type="text" name="location" value="{{ $attendanceData->location }}" id="location"
                                        class="form-control" autofocus autocomplete="off" required readonly>
                                    </div>
                                    
                                    <div class="form-group form-group-default required">
                                        <label>Latitude</label>
                                        <input type="text" value="{{ $attendanceData->latitude }}" id="latitude" name="latitude" class="form-control" required readonly>
                                    </div>
                                    
                                    <div class="form-group form-group-default required">
                                        <label>Longitude</label>
                                        <input type="text" value="{{ $attendanceData->longitude }}" id="longitude" name="longitude" class="form-control" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <div id="map" style="height: 500px;"></div>
                                    </div>
                                    
                                    <div class="text-right">
                                        @if ($attendanceStatus != 'Clock In')
                                            <button type="button" onclick="update()" class="btn btn-complete">
                                                Update
                                            </button>
                                        @endif

                                        <button type="submit" class="btn {{ $attendanceStatus == 'Clock In' ? 'btn-complete' : 'btn-danger' }} {{ $attendanceStatus == 'Already Recorded' ? 'd-none' : '' }}">
                                            {{ $attendanceStatus }}
                                        </button>
                                        <a href="{{ URL::previous() }}" class="btn btn-complete">
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
        @include('dashboard.partials.footer')
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
@endsection

@section('javascript')
    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/classie/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-autonumeric/autoNumeric.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/handlebars/handlebars-v4.0.5.js') }}"></script>
    <script src="{{ asset('assets/js/form_elements.js') }}" type="text/javascript"></script>

    <!-- END VENDOR JS -->

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: "{{ Session::get('status') }}",
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif

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
            if (`{{ $attendanceStatus }}` != 'Already Recorded') {
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
            let planningActivity = document.getElementById('planningActivity');
            let choice = document.getElementById('workLoadStatus');
            let choiceText = choice.options[choice.selectedIndex].innerHTML
            let formData = {
                planningActivity: planningActivity.value,
                workLoadStatus: choiceText,
                updatedBy: `{{ Session::get('userId') }}`
            }
            $.ajax({
                url: `{{ $url }}attendances/{{ $id }}`,
                type: "PATCH",
                dataType: "json",
                data: formData,
                success: function(data) {
                    window.location.href = "{{ route('dashboard.index') }}"
                },
            })
        }
    </script>

    <!-- Adding a script for dropzone -->
@endsection
