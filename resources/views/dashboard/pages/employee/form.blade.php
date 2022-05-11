@extends('dashboard.partials.app')

@section('title', 'Employee')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Employee</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $user->id != '' ? 'Edit' : 'Invite' }} Employee</h2>
            <p class="section-lead">
                You can {{ $user->id != '' ? 'edit' : 'invite new' }} employee here.
            </p>

            <form action="{{ $user->id == '' ? route('employee.send_invitational') : route('employee.update', $user->id) }}"
                method="POST" class="needs-validation" novalidate="">
                @csrf
                @if ($user->id != '')
                    @method('patch')
                @endif
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>Input Text</h4>
                            </div> --}}
                            <div class="card-body">
                                <input type="hidden" name="id" value="">

                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <input type="text" name="employee_id"
                                        value="{{ old('employee_id', $user->employee_id) }}" class="form-control"
                                        autofocus autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the Employee Id</div>
                                </div>

                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                        class="form-control" autofocus autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the Full Name</div>
                                </div>
                                @if ($user->id == '')
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="form-control" autofocus autocomplete="off" required>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="col-form-label">
                                        Address
                                    </label>
                                    <textarea class="form-control" name="address">{{ old('address', $user->address) }}</textarea>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Avatar</label>
                                    <input name="avatar" type="file" class="form-control">
                                    <div class="invalid-feedback">Please fill in your thumbnail</div>

                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4>Preview Image</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="gallery gallery-md">
                                                <div class="gallery-item"
                                                    data-image="https://95.111.202.9:3068/storage/attachment/attendances/clockIn/clockInPhoto-1652155617729-985650678.jpeg"
                                                    data-title="Image 1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control select2" name="RoleId" id="RoleId">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $role->id == old('RoleId', $user->RoleId) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">
                        {{ $user->id != '' ? 'Update' : 'Save' }}
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
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>


    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

@endsection


@push('active.employee')
    active
@endpush
