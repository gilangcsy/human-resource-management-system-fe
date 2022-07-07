@extends('dashboard.partials.app')

@section('title', 'Leave')

@section('css')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <link href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css"
        media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" media="screen">
    <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
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
                            <li class="breadcrumb-item"><a href="#">Self Service</a></li>
                            <li class="breadcrumb-item"><a href="/leave">Leave</a></li>
                            <li class="breadcrumb-item active">{{ $leave->id != '' ? 'Edit' : 'Create' }}</li>
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
                        <form method="POST"
                            action="{{ $leave->id == '' ? route('leave.store') : route('leave.update', $leave->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($leave->id != '')
                                @method('patch')
                            @endif

                            <div class="form-group form-group-default form-group-default-select2 required">
                                <label>Leave Type</label>
                                <select class="full-width" data-placeholder="Select Type" name="LeaveTypeId"
                                    id="LeaveTypeId" data-init-plugin="select2">
                                    @foreach ($leaveType as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $leave->LeaveTypeId ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-daterange input-group">
                                <input type="date" placeholder="From" class="input-sm form-control" name="start_date"
                                    value="{{ $leave->start_date != ''? \Carbon\carbon::parse(strtotime($leave->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d'): '' }}"
                                    required min="2022-01-01" max="2050-01-01" />
                                <div class="input-group-addon">to</div>
                                <input type="date" placeholder="To" class="input-sm form-control" name="end_date"
                                    value="{{ $leave->end_date != ''? \Carbon\carbon::parse(strtotime($leave->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('Y-m-d'): '' }}"
                                    required />
                            </div>

                            <div class="form-group form-group-default mt-3">
                                <label>Description</label>
                                <input type="text" value="{{ old('description', $leave->description) }}"
                                    name="description" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Attachment</label>
                                <input type="file" accept="application/pdf" name="attachment[]" class="form-control"
                                    multiple>
                            </div>
                            @if ($leave->attachment != null)
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">Attachment
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <div class="card card-default">
                                                <div class="card-body">
                                                    <?php
                                                        $attachment = $leave->attachment;
                                                        $jml = count($attachment) - 1;
                                                        for ($i = 0; $i <= $jml; $i++) { ?>
                                                            <a href="{{ $download_url . $attachment[$i] }}" class="btn btn-default btn-xs mt-2">
                                                                {{ $attachment[$i] }}
                                                            </a>
                                                            <a href="#" data-attach="{{ $attachment[$i] }}" class="btn btn-danger btn-xs mt-2 remove-attach" onclick="return confirm('Are you sure?')">
                                                                <span class="pg-icon">trash</span>
                                                            </a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ $leave->id != '' ? 'Update' : 'Save' }}
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
    <script src="{{ asset('assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
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
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: "{{ Session::get('status') }}",
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif
    @if ($leave->id != '')
        <script>
            $('.remove-attach').on('click', function () {
                let attachmentFile = $(this).attr('data-attach')

                let attachmentData = {
                    leaveId: '{{ $leave->id }}',
                    attachment: attachmentFile
                }

                $.ajax({
                        url: `{{ $url }}leaves/attachment/remove`,
                        type: 'DELETE',
                        dataType: 'JSON',
                        headers: {
                            'x-access-token':"{{ Session::get('token') }}"
                        },
                        data: attachmentData,
                        success: function(data) {
                            location.reload()
                        },
                    })
            })
        </script>
    @endif
@endsection
