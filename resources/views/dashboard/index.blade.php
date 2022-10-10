@extends('dashboard.partials.app')

@section('title', 'Dashboard')

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
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class=" container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                
                <div class="row">
                    <div class="col-md-4">
                        <!-- START WIDGET widget_weatherWidget-->
                        <div class="widget-17 card no-border no-margin widget-loader-circle">
                            <div class="card-header ">
                                <div class="card-title">
                                    <i class="pg-icon">calendar</i> Attendances
                                    <span class="caret"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="p-l-5">
                                    <div class="row">
                                        <div class="col-lg-12 col-xlg-12">
                                            <div class="row m-t-10">
                                                <div class="col-lg-5">
                                                    <h4 class="no-margin">{{ date('l') }}</h4>
                                                    <p class="small hint-text">{{ date('d M Y') }}</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="d-flex pull-right">
                                                        <canvas height="46" width="46" class="clear-day hint-text"></canvas>
                                                        {{-- <h2 class="text-danger bold no-margin p-l-10">
                                                            <i class="pg-icon">busy</i>
                                                        </h2> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-t-25 p-b-10">
                                                <p class="hint-text">
                                                    Planning Activity
                                                </p>
                                                <p class="pull-left no-margin">
                                                    {{ $attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->planningActivity }}
                                                </p>

                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="widget-17-weather b-t b-grey p-t-20">
                                                <div class="weather-info row">
                                                    <div class="col-12 p-r-15">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Clock In</p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    {{ $attendanceStatus == 'Clock In'? 'N/A': \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Clock Out </p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    {{ $attendanceStatus == 'Clock In' || $attendanceStatus == 'Clock Out'? 'N/A': \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p class="pull-left no-margin hint-text fs-13">Status</p>
                                                                <p class="pull-right no-margin fs-13">
                                                                    {{ $attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->workLoadStatus }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-t-20 timeslot">
                                                <div class="col-lg-12">
                                                    <a href="{{ $attendanceStatus == 'Clock In' ? route('attendance.create') : route('attendance.edit', $attendanceData->id) }}"
                                                        class="btn {{ $attendanceStatus == 'Clock In' ? 'btn-primary' : 'btn-danger' }} {{ $attendanceStatus == 'Already Recorded' ? 'd-none' : '' }}">{{ $attendanceStatus == 'Clock In' ? 'New Attendance' : $attendanceStatus }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>
                    <div class="col-lg-8">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- START WIDGET widget_progressTileFlat-->
                                        <div class="widget-9 card bg-primary widget-loader-bar">
                                            <div class="full-height d-flex flex-column">
                                                <div class="card-header ">
                                                    <div class="card-title">
                                                        @php
                                                            $startDate = date('Y-m-01');
                                                            $startDate = new DateTime($startDate);
                                                            $endDate = new DateTime();
                                                            $endDate = $endDate->format('Y-m-t');
                                                            $endDate = new DateTime($endDate);
                                                            
                                                            $difference = $endDate->diff($startDate);
                                                            
                                                        @endphp
                                                        <span class="font-montserrat fs-11 all-caps">Leave</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="p-l-20">
                                                            <h3 class="no-margin p-b-5">{{ $leaveCount }}</h3>
                                                            <span class="d-flex align-items-center">
                                                                <i class="pg-icon m-r-5">grid</i>
                                                                <span class="small hint-text">Application</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="pg-icon pull-right mr-4" style="font-size:36pt">folder</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-auto">
                                                    <div class="col-12">
                                                        <div class="progress progress-small m-b-20">
                                                            <!-- START BOOTSTRAP PROGRESS (http://getbootstrap.com/components/#progress) -->
                                                            <div class="progress-bar progress-bar-white" style="width:45%"></div>
                                                            <!-- END BOOTSTRAP PROGRESS -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- START WIDGET widget_progressTileFlat-->
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET -->
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- START WIDGET widget_progressTileFlat-->
                                        <div class="widget-9 card bg-success widget-loader-bar">
                                            <div class="full-height d-flex flex-column">
                                                <div class="card-header ">
                                                    <div class="card-title">
                                                        <span class="font-montserrat fs-11 all-caps">Claim</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="p-l-20">
                                                            <h3 class="no-margin p-b-5">{{ $claimCount }}</h3>
                                                            <span class="d-flex align-items-center">
                                                                <i class="pg-icon m-r-5">grid</i>
                                                                <span class="small hint-text">Application</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="pg-icon pull-right mr-4" style="font-size:36pt">folder</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-auto">
                                                    <div class="col-12">
                                                        <div class="progress progress-small m-b-20">
                                                            <!-- START BOOTSTRAP PROGRESS (http://getbootstrap.com/components/#progress) -->
                                                            <div class="progress-bar progress-bar-white" style="width:45%"></div>
                                                            <!-- END BOOTSTRAP PROGRESS -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <canvas id="claimChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- START card -->
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Open Task
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-dashboard">
                                    <thead>
                                        <tr>
                                            <th width="10"> No.</th>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Priority</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @php
                                            $currentDateTime = date('d M Y');
                                            $today_time = strtotime($currentDateTime);
                                            
                                        @endphp
                                        @foreach ($tasks->myTask as $item)
                                            <tr>
                                                @php
                                                    $expire_time = strtotime($item->endDate);
                                                    $bg = 'badge badge-success';
                                                    if ($expire_time < $today_time) {
                                                        $bg = 'badge badge-danger';
                                                    }
                                                @endphp
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <span class="{{ $bg }}">
                                                        {{ \Carbon\carbon::parse(strtotime($item->startDate))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y ') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="{{ $bg }}">
                                                        {{ \Carbon\carbon::parse(strtotime($item->endDate))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y ') }}
                                                    </span>
                                                </td>
                                                <td>{{ $item->priority == 1 ? 'High' : ($item->priority == 2 ? 'Medium' : 'Low') }}</td>
                                                <td>
                                                    @php
                                                    $badgeColor = '';
                                                        if($item->status == 'Open') {
                                                            $badgeColor = 'success';
                                                        } else if($item->status == 'Closed' || $item->status == 'Cancel') {
                                                            $badgeColor = 'danger';
                                                        } else {
                                                            $badgeColor = 'warning';
                                                        }
                                                    @endphp
                                                    <span class="badge badge-{{ $badgeColor }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END card -->
                    </div>

                    <div class="col-12">
                        <!-- START card -->
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Member Task
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-dashboard">
                                    <thead>
                                        <tr>
                                            <th width="10"> No.</th>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Priority</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @php
                                            $currentDateTime = date('d M Y');
                                            $today_time = strtotime($currentDateTime);
                                            
                                        @endphp
                                        @foreach ($tasks->memberTask as $item)
                                        
                                            @php
                                                $expire_time = strtotime($item->endDate);
                                                $bg = 'badge badge-success';
                                                if ($expire_time < $today_time) {
                                                    $bg = 'badge badge-danger';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <span class="{{ $bg }}">
                                                        {{ \Carbon\carbon::parse(strtotime($item->startDate))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y ') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="{{ $bg }}">
                                                        {{ \Carbon\carbon::parse(strtotime($item->endDate))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y ') }}
                                                    </span>
                                                </td>
                                                <td>{{ $item->priority == 1 ? 'High' : ($item->priority == 2 ? 'Medium' : 'Low') }}</td>
                                                <td>
                                                    @php
                                                    $badgeColor = '';
                                                        if($item->status == 'Open') {
                                                            $badgeColor = 'success';
                                                        }
                                                    @endphp
                                                    <span class="badge badge-{{ $badgeColor }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- START card -->
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Employee Birthday
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-dashboard">
                                    <thead>
                                        <tr>
                                            <th width="10"> No.</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($birthdayEmployee as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->full_name }}</td>
                                                <td>{{ $item->ttl }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END card -->
                    </div>
                </div>
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
    @if (Session::has('status'))
        <script>
            $(document).ready(function() {
                // Simple notification having bootstrap's .alert class
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: "{{ Session::get('status') }}",
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

    
    <!-- BEGIN VENDOR JS -->
    <script src="assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js"
        type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/datatables.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->

    <script src="assets/js/dashboard.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = [
            'Waiting',
            'Rejected',
            'Approved'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Leave Dataset',
                backgroundColor: ['#FFd945',  '#D83C31', '#148e63'],
                data: [{{$waitingLeave}}, {{ $rejectedLeave }}, {{ $approvedLeave }}],
            }]
        };

        const dataClaim = {
            labels: labels,
            datasets: [{
                label: 'Claim Dataset',
                backgroundColor: ['#FFd945',  '#D83C31', '#148e63'],
                data: [{{$waitingClaim}}, {{ $rejectedClaim }}, {{ $approvedClaim }}],
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Leave Status'
                    }
                }
            },
        };

        const configClaim = {
            type: 'pie',
            data: dataClaim,
            options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Claim Status'
                    }
                }
            },
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        const claimChart = new Chart(
            document.getElementById('claimChart'),
            configClaim
        );

        $('document').ready(function () {
            // setInterval(function () {getRealData()}, 4000);//request every x seconds
        }); 

            function getRealData() {
                $.ajax({
                    url: `{{ $base_url }}leaves/15`,
                    type: 'GET',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {
                        console.log(data)
                    },
                })
            }
    </script>

@endsection