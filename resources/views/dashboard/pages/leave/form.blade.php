@extends('dashboard.partials.app')

@section('title', 'Leave Application')

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
            <h1>Leave</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $leave->id != '' ? 'Edit' : 'Add' }} Leave</h2>
            <p class="section-lead">
                You can {{ $leave->id != '' ? 'edit' : 'add' }} new leave application here.
            </p>

            <form action="{{ $leave->id == '' ? route('leave.store') : route('leave.update', $leave->id) }}" method="POST"
                class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @if ($leave->id != '')
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
                                    <label>Leave Type</label>
                                    <select class="form-control select2" name="LeaveTypeId" id="LeaveTypeId">
                                        @foreach ($leaveType as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $leave->LeaveTypeId ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" value="{{ $leave->start_date != '' ? \Carbon\carbon::parse(strtotime($leave->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : '' }}"
                                        class="form-control" autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the start date</div>
                                    @if ($errors->has('start_date'))
                                        <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" value="{{ $leave->end_date != '' ? \Carbon\carbon::parse(strtotime($leave->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d') : '' }}"
                                        class="form-control" autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the end date</div>
                                    @if ($errors->has('end_date'))
                                        <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{ $leave->description }}</textarea>
                                    <div class="invalid-feedback">Please fill in the description</div>
                                    @if ($errors->has('description'))
                                        <div class="text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label>Attachment</label>
                                    <input type="file" accept="application/pdf" name="attachment" value="{{ $leave->attachment != '' ? $leave->attachment : '' }}"
                                        class="form-control" autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the attachment</div>
                                    @if ($errors->has('attachment'))
                                        <div class="text-danger">{{ $errors->first('attachment') }}</div>
                                    @endif
                                </div>
                                @if ($leave->attachment != null)
                                    <div class="card card-primary col-4">
                                        <div class="card-header">
                                            <h4>Attachment File</h4>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                <a href="{{ $download_url . $leave->attachment }}">
                                                    <code>{{ $leave->attachment }}</code>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ $leave->id != '' ? 'Update' : 'Save' }}
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


@push('active.leave')
    active
@endpush
