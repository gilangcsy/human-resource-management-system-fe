@extends('dashboard.partials.app')

@section('title', 'My Attendance')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
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
            <h1>Leave Type</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $leaveType->id != '' ? 'Edit' : 'Add' }} Leave Type</h2>
            <p class="section-lead">
                You can {{ $leaveType->id != '' ? 'edit' : 'add' }} new type of leave here.
            </p>

            <form action="{{ $leaveType->id == '' ? route('leave-type.store') : route('leave-type.update', $leaveType->id) }}"
                method="POST" class="needs-validation" novalidate="">
                @csrf
                @if ($leaveType->id != '')
                    @method('patch')
                @endif
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>Input Text</h4>
                            </div> --}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        value="{{ $leaveType->name != '' ? $leaveType->name : '' }}" class="form-control"
                                        autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the name</div>
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ $leaveType->id != '' ? 'Update' : 'Save' }}
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

@endsection


@push('active.leave-type')
    active
@endpush
