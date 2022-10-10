@extends('dashboard.partials.app')

@section('title', 'Approval Template')

@section('css')
<link href="{{asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" media="screen">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" media="screen">
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
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item"><a href="/approval-authorization">Approval Authorization</a></li>
                            <li class="breadcrumb-item active">{{ $approvalAuthorization->id != '' ? 'Edit' : 'Create' }}</li>
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
                        <form method="POST" action="{{ $approvalAuthorization->id == '' ? route('approval-authorization.store') : route('approval-authorization.update', $approvalAuthorization->id) }}">
                            @csrf
                            @if ($approvalAuthorization->id != '')
                                @method('patch')
                            @endif
                            
                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label>Role</label>
                                <select class="full-width" name="RoleId" data-init-plugin="select2">
                                    @foreach ($roles as $item)
                                        <optgroup label="{{ $item->name }}">
                                            @foreach ($item->Roles as $role)
                                                <option value="{{ $role->id }}" {{ $role->id == old('RoleId', $approvalAuthorization->role_id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label class="">Approval Template</label>
                                <select class="full-width" name="ApprovalTemplateId" data-init-plugin="select2">
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
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ $approvalAuthorization->id != '' ? 'Update' : 'Save' }}
                                </button>
                                <a href="{{ URL::previous() }}" class="btn btn-primary">
                                    Back
                                </a>
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
    <script src="{{ asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
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
            $(document).ready(function () {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '{{Session::get("error")}}',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif
@endsection

