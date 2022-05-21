@extends('dashboard.partials.app')

@section('title', 'Approval Claim')

@section('css')
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css"
        rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="assets/css/style.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="#">Monitoring</a></li>
                            <li class="breadcrumb-item active">Approval Claim</li>
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
                <div class="card card-borderless">
                    <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item">
                            <a class="active" data-toggle="tab" role="tab" data-target="#tab2hellowWorld" href="#">
                                All
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" role="tab" data-target="#tab2FollowUs">History</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab2hellowWorld">
                            <form action="{{ route('approval-claim.action') }}" method="POST">
                                <div class="card card-transparent">
                                    <div class="card-header">
                                        <div class="card-title">
                                            @csrf
                                            <button type="submit" class="btn btn-complete approve">Approve</button>
                                            <button type="submit" class="btn btn-danger reject">Reject</button>
                                            <input type="hidden" name="isApproved" id="isApproved" value="">
                                        </div>
                                        <div class="pull-right">
                                            <div class="col-xs-12">
                                                <input type="text" id="search-table2" class="form-control pull-right"
                                                    placeholder="Search">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="tableWithSearch2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup"
                                                                data-checkbox-role="dad" class="custom-control-input"
                                                                id="checkbox-all">
                                                            <label for="checkbox-all"
                                                                class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th>Employee</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($claims as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $loop->iteration }}" name="action[]"
                                                                    value="{{ $item['id'] }}">
                                                                <label for="checkbox-{{ $loop->iteration }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <b>{{ $item['requester_emp_id'] }}</b>
                                                            <br>
                                                            {{ $item['requester_name'] }}
                                                        </td>
                                                        <td>{{ \Carbon\carbon::parse(strtotime($item['start_date']))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                            -
                                                            {{ \Carbon\carbon::parse(strtotime($item['end_date']))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                        </td>
                                                        <td>{{ $item['description'] }}</td>
                                                        <td>
                                                            @php
                                                                $badge = 'badge-warning';
                                                                if ($item['last_status'] == 'Approved') {
                                                                    $badge = 'badge-success';
                                                                } elseif ($item['last_status'] == 'Rejected') {
                                                                    $badge = 'badge-danger';
                                                                }
                                                            @endphp
                                                            <span class="badge {{ $badge }}">
                                                                {{ $item['last_status'] }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane " id="tab2FollowUs">

                            <!-- START card -->
                            <div class="card card-transparent">
                                <div class="card-header">
                                    <div class="pull-right">
                                        <div class="col-xs-12">
                                            <input type="text" id="search-table" class="form-control pull-right"
                                                placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="tableWithSearch">
                                        <thead>
                                            <tr>
                                                <th width="10">No.</th>
                                                <th>Employee</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Attachment</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($history as $item)
                                                @php
                                                    if ($item['approver_one'] == session()->get('userId')) {
                                                        $approverPosition = 'approval_one_status';
                                                    } else if ($item['approver_two'] == session()->get('userId')) {
                                                        $approverPosition = 'approval_two_status';
                                                    } else if ($item['approver_three'] == session()->get('userId')) {
                                                        $approverPosition = 'approval_three_status';
                                                    }
                                                @endphp

                                                @if ($item[$approverPosition] == 'Approved' OR $item[$approverPosition] == 'Rejected' )
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <b>{{ $item['requester_emp_id'] }}</b>
                                                            <br>
                                                            {{ $item['requester_name'] }}
                                                        </td>

                                                        <td>
                                                            {{ \Carbon\carbon::parse(strtotime($item['start_date']))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                            -
                                                            {{ \Carbon\carbon::parse(strtotime($item['end_date']))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                        </td>
                                                        <td>{{ $item['description'] }}</td>
                                                        <td>
                                                            @if ($item['attachment'] != null)
                                                                <a href="{{ $download_url . $item['attachment'] }}">
                                                                    {{ $item['attachment'] }}
                                                                </a>
                                                            @else
                                                                No Attachment.
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $badge = 'badge-warning';
                                                                if ($item['last_status'] == 'Approved') {
                                                                    $badge = 'badge-success';
                                                                } elseif ($item['last_status'] == 'Rejected') {
                                                                    $badge = 'badge-danger';
                                                                }
                                                            @endphp
                                                            <span
                                                                class="badge {{ $badge }}">{{ $item['last_status'] }}</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END card -->
                        </div>
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
    <script src="assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js"
        type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/datatables.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->

    @if (Session::has('status'))
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: '{{ Session::get('status') }}',
                    position: 'top',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    @endif
    
    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: "{{ Session::get('error') }}",
                    position: 'top',
                    timeout: 4000,
                    type: 'danger'
                }).show();
            });
        </script>
    @endif

    <script>
        let isApproved = document.getElementById('isApproved')

        $("#checkbox-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        })

        $('.approve').click(function() {
            isApproved.value = 'true'
        })
        $('.reject').click(function() {
            isApproved.value = 'false'
        })
    </script>
@endsection
