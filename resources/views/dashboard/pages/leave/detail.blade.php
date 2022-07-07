@extends('dashboard.partials.app')

@section('title', 'Leave Detail')

@section('css')
    <link href="{{asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <link href="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="{{asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="{{asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">Detail</li>
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
                <div class="card card-transparent">
                    <div class="card-header">
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Approver Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $leave->approver_one_name }}</td>
                                    <td>
                                        <span class="badge {{ $leave->approval_one_status == 'Approved' ? 'badge-success' : ($leave->approval_one_status == 'Rejected' ? 'badge-danger' : 'badge-warning') }}">{{ $leave->approval_one_status  }}</span>
                                    </td>
                                </tr>
                                @if ($leave->approver_two != null)
                                    <tr>
                                        <td>2</td>
                                        <td>{{ $leave->approver_two_name }}</td>
                                        <td>
                                            <span class="badge {{ $leave->approval_two_status == 'Approved' ? 'badge-success' : ($leave->approval_two_status == 'Rejected' ? 'badge-danger' : 'badge-warning') }}">{{ $leave->approval_two_status  }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if ($leave->approver_three != null)
                                    <tr>
                                        <td>3</td>
                                        <td>{{ $leave->approver_three_name }}</td>
                                        <td>
                                            <span class="badge {{ $leave->approval_three_status == 'Approved' ? 'badge-success' : ($leave->approval_three_status == 'Rejected' ? 'badge-danger' : 'badge-warning') }}">{{ $leave->approval_three_status  }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
    <script src="{{asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"
        type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript" src="{{asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="{{asset('assets/js/datatables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->

    @if (Session::has('status'))
        <script>
            $(document).ready(function () {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '{{Session::get("status")}}',
                    position: 'top',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    @endif
@endsection

