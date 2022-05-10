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

                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input id="longitude" type="text" class="form-control" name="longitude" tabindex="1" required
                                    autofocus readonly>
                                <div class="invalid-feedback">
                                    Please fill in your longitude
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input id="latitude" type="text" class="form-control" name="latitude" tabindex="1" required
                                    autofocus readonly>
                                <div class="invalid-feedback">
                                    Please fill in your latitude
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" name="address" tabindex="1" required
                                    autofocus readonly>
                                <div class="invalid-feedback">
                                    Please fill in your address
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
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
        let addredd = document.getElementById('address');
        function getLocation() {
            var options = {
              enableHighAccuracy: true,
              maximumAge: 0
            };
            
            function success(pos) {
              var crd = pos.coords;
            
              console.log('Your current position is:');
              console.log(`Latitude : ${crd.latitude}`);
              console.log(`Longitude: ${crd.longitude}`);
              console.log(`More or less ${crd.accuracy} meters.`);
              
                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${crd.latitude}&lon=${crd.longitude}`, function(data){
                    address.value = data.display_name
                });
                
                latitude.value = crd.latitude
                longitude.value = crd.longitude
            }
            
            function error(err) {
              console.warn(`ERROR(${err.code}): ${err.message}`);
            }
            
            
            navigator.geolocation.getCurrentPosition(success, error, options);
        }
        
        getLocation()
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
