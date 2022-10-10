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
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="/approval-template">Approval Template</a></li>
                            <li class="breadcrumb-item active">{{ $approvalTemplate->id != '' ? 'Edit' : 'Create' }}</li>
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
                        <form method="POST" action="{{ $approvalTemplate->id == '' ? route('approval-template.store') : route('approval-template.update', $approvalTemplate->id) }}">
                            @csrf
                            @if ($approvalTemplate->id != '')
                                @method('patch')
                            @endif
                            <div class="form-group form-group-default required">
                                <label>Name</label>
                                <input type="text" value="{{ old('name', $approvalTemplate->name) }}" name="name" class="form-control" required>
                            </div>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label class="">Approver One</label>
                                <select class="full-width" data-placeholder="Select Approver One" name="approver_one" data-init-plugin="select2">
                                    @foreach ($roles as $item)
                                        <optgroup label="{{ $item->name }}">
                                            @foreach ($item->Users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == old('approver_one', $approvalTemplate->approver_one_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label class="">Approver Two</label>
                                <select class="full-width" data-placeholder="Select Approver One" name="approver_two" data-init-plugin="select2">
                                    <option value="">-- Select Approver Two --</option>
                                    @foreach ($roles as $item)
                                        <optgroup label="{{ $item->name }}">
                                            @foreach ($item->Users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == old('approver_two', $approvalTemplate->approver_two_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label class="">Approver Three</label>

                                <select class="full-width" data-placeholder="Select Approver One" name="approver_three" data-init-plugin="select2">
                                    <option value="">-- Select Approver Three --</option>
                                    @foreach ($roles as $item)
                                        <optgroup label="{{ $item->name }}">
                                            @foreach ($item->Users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == old('approver_three', $approvalTemplate->approver_three_id) ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label class="">Type</label>
                                <select class="full-width" data-placeholder="Select Type" name="type" data-init-plugin="select2">
                                    <option value="Claim" {{ $approvalTemplate->type == 'Claim' ? 'selected' : '' }}>Claim</option>
                                    <option value="Leave" {{ $approvalTemplate->type == 'Leave' ? 'selected' : '' }}>Leave</option>
                                </select>
                            </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ $approvalTemplate->id != '' ? 'Update' : 'Save' }}
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
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small-text no-margin pull-left sm-pull-reset">
                    ©2014-2020 All Rights Reserved. Pages® and/or its subsidiaries or affiliates are registered
                    trademark of Revox Ltd.
                    <span class="hint-text m-l-15">Pages v05.23 20201105.r.190</span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    Hand-crafted <span class="hint-text">&amp; made with Love</span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
@endsection

@section('javascript')
    {{-- @if (Session::has('status'))
        <script>
            let status = document.getElementById('status').value
            iziToast.success({
                title: `Menu Management.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Menu Management.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif --}}

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
                    message: '{{Session::get("status")}}',
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif
@endsection
