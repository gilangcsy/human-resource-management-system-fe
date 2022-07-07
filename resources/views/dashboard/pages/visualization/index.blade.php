@extends('dashboard.partials.app')

@section('title', 'Visualization')

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
                            <li class="breadcrumb-item"><a href="#">Visualization</a></li>
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
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="widget-9 card bg-primary widget-loader-bar">
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
                    </div>
                    <div class="col-md-4">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="widget-9 card bg-primary widget-loader-bar">
                            <div class="full-height d-flex flex-column">
                                <div class="card-header ">
                                    <div class="card-title">
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
                    </div>
                    <div class="col-md-4">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="widget-9 card bg-primary widget-loader-bar">
                            <div class="full-height d-flex flex-column">
                                <div class="card-header ">
                                    <div class="card-title">
                                        <span class="font-montserrat fs-11 all-caps">Employee</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="p-l-20">
                                            <h3 class="no-margin p-b-5">{{ $usersData->total }}</h3>
                                            <span class="d-flex align-items-center">
                                                <i class="pg-icon m-r-5">grid</i>
                                                <span class="small hint-text">People</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <span class="pg-icon pull-right mr-4" style="font-size:36pt">users</span>
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="claimChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>
                    <div class="col-lg-3">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="genderChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>
                    <div class="col-lg-3">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="roleChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- START WIDGET widget_progressTileFlat-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="leaveChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
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
    <script src="assets/js/dashboard.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <script>
        $.ajax({
            url: `{{ $base_url }}users/genderAndRole/count`,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                const labelsRole = data.data.role.header
                const valueRole = data.data.role.role
                const backgroundTemplate = ['#003049',  '#d62828', '#f77f00', '#2c6e49', '#7400b8']

                let backgroundColorRole = []

                for (let i = 0; i < labelsRole.length; i++) {
                    backgroundColorRole.push(backgroundTemplate[i])
                }

                const dataRole = {
                    labels: labelsRole,
                    datasets: [{
                        label: 'Role',
                        backgroundColor: backgroundColorRole,
                        data: valueRole
                    }]
                }

                const configRole = {
                    type: 'doughnut',
                    data: dataRole,
                    options: {
                            responsive: true,
                            plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'Role'
                            }
                        }
                    },
                }

                const roleChart = new Chart(
                    document.getElementById('roleChart'),
                    configRole
                )
            },
        })

        $.ajax({
            url: `{{ $base_url }}visualizations/leaveAndClaim`,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                let claim = data.data.claim
                let leave = data.data.leave

                const labelsLeave = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ]

                const dataLeave = {
                    labels: labelsLeave,
                    datasets: [
                        {
                            label: 'Leave',
                            data: [leave.Jan, leave.Feb, leave.Mar, leave.Apr, leave.May, leave.Jun, leave.Jul, leave.Aug, leave.Sep, leave.Oct, leave.Nov, leave.Des],
                            backgroundColor: '#3a86ff',
                        },
                        {
                            label: 'Claim',
                            data: [claim.Jan, claim.Feb, claim.Mar, claim.Apr, claim.May, claim.Jun, claim.Jul, claim.Aug, claim.Sep, claim.Oct, claim.Nov, claim.Des],
                            backgroundColor: '#ff595e',
                        },
                    ]
                }

                const configLeave = {
                    type: 'bar',
                    data: dataLeave,
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Leave Application'
                        }
                        }
                    }
                }
                
                const leaveChart = new Chart(
                    document.getElementById('leaveChart'),
                    configLeave
                )

                // const dataRole = {
                //     labels: labelsRole,
                //     datasets: [{
                //         label: 'Role',
                //         backgroundColor: backgroundColorRole,
                //         data: valueRole
                //     }]
                // }

                // const configRole = {
                //     type: 'doughnut',
                //     data: dataRole,
                //     options: {
                //             responsive: true,
                //             plugins: {
                //             legend: {
                //                 position: 'bottom',
                //             },
                //             title: {
                //                 display: true,
                //                 text: 'Role'
                //             }
                //         }
                //     },
                // }

                // const roleChart = new Chart(
                //     document.getElementById('roleChart'),
                //     configRole
                // )
            },
        })

        const labels = [
            'Waiting',
            'Rejected',
            'Approved'
        ]

        const labelsGender = [
            'Men',
            'Women'
        ]
        
        const data = {
            labels: labels,
            datasets: [{
                label: 'Leave Dataset',
                backgroundColor: ['#ffca3a',  '#ff595e', '#8ac926'],
                data: [{{$waitingLeave}}, {{ $rejectedLeave }}, {{ $approvedLeave }}],
            }]
        }

        const dataClaim = {
            labels: labels,
            datasets: [{
                label: 'Claim Dataset',
                backgroundColor: ['#ffca3a',  '#ff595e', '#8ac926'],
                data: [{{$waitingClaim}}, {{ $rejectedClaim }}, {{ $approvedClaim }}],
            }]
        }
        
        const dataGender = {
            labels: labelsGender,
            datasets: [{
                label: 'Gender',
                backgroundColor: ['#3a86ff',  '#ff595e'],
                data: [{{ $usersData->gender->men }}, {{ $usersData->gender->women }}],
            }]
        }

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
        }

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
        }

        const configGender = {
            type: 'doughnut',
            data: dataGender,
            options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Gender'
                    }
                }
            },
        }

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        )

        const claimChart = new Chart(
            document.getElementById('claimChart'),
            configClaim
        )

        const genderChart = new Chart(
            document.getElementById('genderChart'),
            configGender
        )

    </script>

@endsection
