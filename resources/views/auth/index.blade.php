@extends('auth.partials.app')

@section('content')
    <div class="container mt-5">
        <input type="hidden" id="status" value="{{ Session::get('status') }}">
        <input type="hidden" id="error" value="{{ Session::get('error') }}">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    IDS Intranet
                    {{-- <img src="{{asset('images/logo.jpeg')}}" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.store') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="auth-forgot-password.html" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <div class="form-group d-none">
                                <label for="longitude">Longitude</label>
                                <input id="longitude" type="text" class="form-control" name="longitude" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your longitude
                                </div>
                            </div>
                            
                            <div class="form-group d-none">
                                <label for="latitude">Latitude</label>
                                <input id="latitude" type="text" class="form-control" name="latitude" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your latitude
                                </div>
                            </div>

                            <div class="form-group d-none">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" name="address" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your address
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                            <div class="form-group">
                                <video id="webcam" autoplay playsinline width="640" height="480"></video>
                                <canvas id="canvas"></canvas>

                                <a href="#" id="download" download onclick="take()">SNAP</a>
                            </div>
                        </form>

                    </div>
                </div>
                <div id="map" style="height: 500px; display:none"></div>
                <div class="mt-5 text-muted text-center">
                    Don't have an account? <a href="">Call the admin to inviting you.</a>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let longitude = document.getElementById('longitude');
        let latitude = document.getElementById('latitude');
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
    
            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
                .bindPopup('This is where I Am :D')
                .openPopup();

                latitude.value = position.coords.latitude
                longitude.value = position.coords.longitude

                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.coords.latitude}&lon=${position.coords.longitude}`, function(data){
                    address.value = data.display_name
                });
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
    </script>
    @if (Session::has('status'))
        <script>
            let status = document.getElementById("status").value;
            iziToast.success({
                title: 'Authentication. ',
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById("error").value;
            iziToast.error({
                title: 'Authentication. ',
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection
