@extends('dashboard.partials.app')

@section('title', 'My Attendance')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">

    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Attendance</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Your Attendance</h2>
            <p class="section-lead">
                You can edit your attendance here.
            </p>

            <form action="{{ $attendanceData->id == '' ? route('attendance.store') : route('attendance.update', $attendanceData->id) }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @if ($attendanceData->id != '')
                    @method('patch')
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>Input Text</h4>
                            </div> --}}
                            <div class="card-body">
                                <input type="hidden" name="id" value="">

                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <input type="text" name="employee_id" value="{{Session::get('employee_id')}}"
                                        class="form-control" autocomplete="off" readonly>
                                    <div class="invalid-feedback">Please fill in the Employee Id</div>
                                </div>

                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input type="text" name="full_name" value="{{Session::get('full_name')}}"
                                        class="form-control" autocomplete="off" readonly>
                                    <div class="invalid-feedback">Please fill in the Full Name</div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Clock In</label>
                                    <input type="text" name="employee_id" value="{{ $attendanceData->clockIn != '' ? \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y - H:i') : '' }}"
                                        class="form-control" autocomplete="off" readonly>
                                </div>

                                <div class="form-group text-center">
                                    <img alt="clock in selfie" width="200" src="{{ $attendanceData->clockInPhoto == '' ? asset('assets/img/avatar/avatar-1.png') : $url_storage . 'storage/images/attendances/clockIn/' . $attendanceData->clockInPhoto}}" width="350" height="350" class=" mr-1 img-thumbnail img-fluid">
                                </div>
                                
                                <div class="form-group">
                                    <label>Clock Out</label>
                                    <input type="text" name="employee_id" value="{{ $attendanceData->clockOut }}"
                                        class="form-control" autocomplete="off" readonly>
                                </div>
                                
                                <div class="form-group text-center">
                                    <img alt="clock in selfie" width="200" src="{{ $attendanceData->clockOutPhoto == '' ? asset('assets/img/avatar/avatar-1.png') : $url_storage . 'storage/images/attendances/clockOut/' . $attendanceData->clockOutPhoto}}" width="350" class="mr-1 img-thumbnail img-fluid">
                                </div>
                                
                                <div class="form-group">
                                    <label>Work Load Status</label>
                                    <select class="form-control select2" name="workLoadStatus" id="workLoadStatus">
                                        <option value="Available" {{ $attendanceData->workLoadStatus == 'Available' ? 'selected' : '' }}>Available</option>
                                        <option value="Moderate" {{ $attendanceData->workLoadStatus == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                                        <option value="Busy" {{ $attendanceData->workLoadStatus == 'Busy' ? 'selected' : '' }}>Busy</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Planning Activity</label>
                                    <input type="text" name="planningActivity" id="planningActivity" value="{{ $attendanceData->planningActivity }}"
                                        class="form-control" autofocus autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the your planning activity</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <video id="webcam" autoplay playsinline class="w-100 h-100"></video>
                                    <canvas id="canvas" style="display: none"></canvas>
                                    <div class="col-12 text-center mt-3">
                                        <a href="#" id="download" class="align-center" download onclick="take()"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Upload Selfie</label>
                                    <input type="file" class="form-control" accept="image/*" name="photo">
                                    @if($errors->has('photo'))
                                        <div class="text-danger">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" name="location" value="{{ $attendanceData->location }}" id="location"
                                        class="form-control" autofocus autocomplete="off" required readonly>
                                </div>

                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" value="{{ $attendanceData->latitude }}" id="latitude"
                                        class="form-control" autofocus autocomplete="off" required readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" value="{{ $attendanceData->longitude }}" id="longitude"
                                        class="form-control" autofocus autocomplete="off" required readonly>
                                </div>

                                <div class="form-group">
                                    <div id="map" style="height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        @if ($attendanceStatus != 'Clock In')
                            <button type="button" onclick="update()" class="btn btn-primary">
                                Update
                            </button>
                        @endif
                        
                        <button type="submit" class="btn {{ $attendanceStatus == 'Clock In' ? 'btn-primary' : 'btn-danger' }} {{ $attendanceStatus == 'Already Recorded' ? 'd-none' : '' }}">
                            {{ $attendanceStatus }}
                        </button>
                        <a href="{{ URL::previous() }}" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js')}}"></script>


    
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

                if(`{{$attendanceStatus}}` != 'Already Recorded') {
                    L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
                        .bindPopup('This is where I Am :D')
                        .openPopup();
                    latitude.value = position.coords.latitude
                    longitude.value = position.coords.longitude
    
                    $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.coords.latitude}&lon=${position.coords.longitude}`, function(data){
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
                    window.location.href = "{{ route('dashboard.index')}}"
                },
            })
        }
    </script>

    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: `Leave.`,
                message: `{{ Session::get('error') }}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection


@push('active.my-attendance')
    active
@endpush

@push('active.self-service')
    active
@endpush
