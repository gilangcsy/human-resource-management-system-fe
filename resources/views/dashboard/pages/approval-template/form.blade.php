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
            <h1>Approval Template</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $approvalTemplate->id != '' ? 'Edit' : 'Add' }} Approval Template</h2>
            <p class="section-lead">
                You can {{ $approvalTemplate->id != '' ? 'edit' : 'add' }} new approval template here.
            </p>

            <form action="{{ $approvalTemplate->id == '' ? route('approval-template.store') : route('approval-template.update', $approvalTemplate->id) }}"
                method="POST" class="needs-validation" novalidate="">
                @csrf
                @if ($approvalTemplate->id != '')
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
                                        value="{{ $approvalTemplate->name != '' ? $approvalTemplate->name : '' }}" class="form-control"
                                        autocomplete="off" required>
                                    <div class="invalid-feedback">Please fill in the name</div>
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label>Approver One</label>
                                    <select class="form-control select2" name="approver_one" id="approver_one">
                                        @foreach ($roles as $role)
                                            <optgroup label="{{ $role->name }}">
                                                @foreach ($users as $user)
                                                    @if ($role->id == $user->RoleId)
                                                        <option value="{{ $user->id }}" {{ $user->id == old('ApprovalTemplateId', $approvalTemplate->approver_one_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Approver Two</label>
                                    <select class="form-control select2" name="approver_two" id="approver_two">
                                        <option value="">-- Select Approver Two --</option>
                                        @foreach ($roles as $role)
                                            <optgroup label="{{ $role->name }}">
                                                @foreach ($users as $user)
                                                    @if ($role->id == $user->RoleId)
                                                        <option value="{{ $user->id }}" {{ $user->id == old('ApprovalTemplateId', $approvalTemplate->approver_two_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Approver Three</label>
                                    <select class="form-control select2" name="approver_three" id="approver_three">
                                        <option value="">-- Select Approver Three --</option>
                                        @foreach ($roles as $role)
                                            <optgroup label="{{ $role->name }}">
                                                @foreach ($users as $user)
                                                    @if ($role->id == $user->RoleId)
                                                        <option value="{{ $user->id }}" {{ $user->id == old('ApprovalTemplateId', $approvalTemplate->approver_three_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control select2" name="type" id="type">
                                        <option value="Claim" {{ $approvalTemplate->type == 'Claim' ? 'selected' : '' }}>Claim</option>
                                        <option value="Leave" {{ $approvalTemplate->type == 'Leave' ? 'selected' : '' }}>Leave</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ $approvalTemplate->id != '' ? 'Update' : 'Save' }}
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


@push('active.approval-template')
    active
@endpush
