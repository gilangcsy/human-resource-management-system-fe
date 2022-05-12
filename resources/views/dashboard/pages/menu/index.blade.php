@extends('dashboard.partials.app')

@section('title', 'Menu Management')

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
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                {{-- <!-- START card -->
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">Pages Default Tables Style
                        </div>
                        <div class="pull-right">
                            <div class="col-xs-12">
                                <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Places</th>
                                    <th>Activities</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="v-align-middle semi-bold">
                                        <p>First Tour</p>
                                    </td>
                                    <td class="v-align-middle"><a href="#" class="btn btn-tag">United States</a><a
                                            href="#" class="btn btn-tag">India</a>
                                        <a href="#" class="btn btn-tag">China</a><a href="#"
                                            class="btn btn-tag">Africa</a>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>it is more then ONE nation/nationality as its fall name is The United Kingdom of
                                            Great Britain and North Ireland..</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>Public</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>April 13,2014 10:13</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="v-align-middle semi-bold">
                                        <p>Second Tour</p>
                                    </td>
                                    <td class="v-align-middle"><a href="#" class="btn btn-tag">United States</a><a
                                            href="#" class="btn btn-tag">India</a>
                                        <a href="#" class="btn btn-tag">China</a><a href="#"
                                            class="btn btn-tag">Africa</a>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>it is more then ONE nation/nationality as its fall name is The United Kingdom of
                                            Great Britain and North Ireland..</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>Public</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>April 13,2014 10:13</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END card --> --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">Portlet Tools
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div data-pages="card" class="card card-default" id="card-basic">
                                            <div class="card-header">
                                                <div class="card-title">Portlet Title
                                                </div>
                                                <div class="card-controls">
                                                    <ul>
                                                        <li><a data-toggle="collapse" class="card-collapse" href="#"><i
                                                                    class="card-icon card-icon-collapse"></i></a>
                                                        </li>
                                                        <li><a data-toggle="refresh" class="card-refresh" href="#"><i
                                                                    class="card-icon card-icon-refresh"></i></a>
                                                        </li>
                                                        <li><a data-toggle="close" class="card-close" href="#"><i
                                                                    class="card-icon card-icon-close"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card card-transparent">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div data-pages="card" class="card card-default" id="card-basic">
                                                                    <div class="card-header">
                                                                        <div class="card-title">Portlet Title
                                                                        </div>
                                                                        <div class="card-controls">
                                                                            <ul>
                                                                                <li><a data-toggle="collapse" class="card-collapse" href="#"><i
                                                                                            class="card-icon card-icon-collapse"></i></a>
                                                                                </li>
                                                                                <li><a data-toggle="refresh" class="card-refresh" href="#"><i
                                                                                            class="card-icon card-icon-refresh"></i></a>
                                                                                </li>
                                                                                <li><a data-toggle="close" class="card-close" href="#"><i
                                                                                            class="card-icon card-icon-close"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                </div>
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
    @if (Session::has('status'))
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
    @endif

    <script>
        $('#tableWithSearch tbody').sortable({
            handle: '.semi-bold',
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('updated')
                    }
                })
                saveNewPositions();
            }
        })

        $(".sortable-table-custom").dataTable({
            "dom": 'frtip',
            "columnDefs": [{
                "sortable": false,
                "targets": [0]
            }]
        })

        function saveNewPositions() {
            let positions = []
            $('.updated').each(function() {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')])
                $(this).removeClass('updated')
            })

            $.ajax({
                url: '{{ $base_url }}master/menu/newPositions',
                method: 'POST',
                dataType: 'TEXT',
                data: {
                    positions: positions
                },
                success: function(response) {
                    location.reload()
                }
            })
        }
    </script>

    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
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
@endsection

@push('active.menu')
    active
@endpush
