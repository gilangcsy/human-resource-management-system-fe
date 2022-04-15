@extends('dashboard.partials.app')

@section('title', 'Approval Authorization')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">


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
            <h1>Approval Authorization</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $approvalAuthorization->id != '' ? 'Edit' : 'Add' }} Approval Authorization</h2>
            <p class="section-lead">
                You can {{ $approvalAuthorization->id != '' ? 'edit' : 'add' }} new approval authorization here.
            </p>

            <form
                action="{{ $approvalAuthorization->id == ''? route('approval-authorization.store'): route('approval-authorization.update', $approvalAuthorization->id) }}"
                method="POST" class="needs-validation" novalidate="">
                @csrf
                @if ($approvalAuthorization->id != '')
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
                                    <label>Role</label>
                                    <input type="hidden" name="RoleId" value="{{ $approvalAuthorization->role_id }}">
                                    <select class="form-control select2" name="RoleId" id="RoleId" {{ $approvalAuthorization->id != null ? 'disabled' : '' }}>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $role->id == old('RoleId', $approvalAuthorization->role_id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Template Approval</label>
                                    <select name="ApprovalTemplateId" class="form-control select2" id="ApprovalTemplateId">
                                        @if ($approvalAuthorization->approval_template_type == 'Claim')
                                            <optgroup label="Claim">
                                                @foreach ($approvalTemplate as $item)
                                                    @if ($item->type == 'Claim')
                                                        <option value="{{ $item->id }}" {{ $item->id == old('ApprovalTemplateId', $approvalAuthorization->approval_template_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @elseif($approvalAuthorization->approval_template_type == 'Leave')
                                            <optgroup label="Leave">
                                                @foreach ($approvalTemplate as $item)
                                                    @if ($item->type == 'Leave')
                                                        <option value="{{ $item->id }}" {{ $item->id == old('ApprovalTemplateId', $approvalAuthorization->approval_template_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @else
                                            
                                        <optgroup label="Claim">
                                            @foreach ($approvalTemplate as $item)
                                                @if ($item->type == 'Claim')
                                                    <option value="{{ $item->id }}" {{ $item->id == old('ApprovalTemplateId', $approvalAuthorization->approval_template_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Leave">
                                            @foreach ($approvalTemplate as $item)
                                                @if ($item->type == 'Leave')
                                                    <option value="{{ $item->id }}" {{ $item->id == old('ApprovalTemplateId', $approvalAuthorization->approval_template_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ $approvalAuthorization->id != '' ? 'Update' : 'Save' }}
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
    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>

    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: `Approval Authorization.`,
                message: `{{ Session::get('error') }}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection


@push('active.approval-authorization')
    active
@endpush
