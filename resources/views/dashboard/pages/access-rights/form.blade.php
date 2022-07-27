@extends('dashboard.partials.app')

@section('title', 'Access Rights')

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
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">Access Rights</li>
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
                                    <th>
                                        No.
                                    </th>
                                    <th>Name</th>
                                    <th>Create</th>
                                    <th>Read</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th></th>
                                </tr>
                            </thead>

                            
                            <tbody>
                                @foreach ($menus as $item_menu)
                                    @php
                                        $allowCreate = '';
                                        $allowRead = '';
                                        $allowUpdate = '';
                                        $allowDelete = '';
                                        $isExists = '';
                                        $checkedAll = '';
                                    @endphp
                                    @foreach ($accessRights as $item)
                                        @php
                                            if ($item_menu->id == $item->menu_id) {
                                                $allowCreate = $item->allow_create;
                                                $allowRead = $item->allow_read;
                                                $allowDelete = $item->allow_delete;
                                                $allowUpdate = $item->allow_update;
                                                $isExists = $item->id;
                                            }
                                            
                                            if ($allowCreate && $allowRead && $allowUpdate && $allowDelete == true) {
                                                $checkedAll = true;
                                            }
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item_menu->master_menu_name }}
                                            <br>
                                            <b>{{ $item_menu->name }}</b>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg primary">
                                                <input type="checkbox" class="checkbox-action" data-user="{{$item_menu->id}}" id="switch-create{{ $loop->iteration }}" {{ $allowCreate == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="create">
                                                <label for="switch-create{{ $loop->iteration }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg primary">
                                                <input type="checkbox" class="checkbox-action" data-user="{{$item_menu->id}}" id="switch-read{{ $loop->iteration }}" {{ $allowRead == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="read">
                                                <label for="switch-read{{ $loop->iteration }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg primary">
                                                <input type="checkbox" class="checkbox-action" data-user="{{$item_menu->id}}" id="switch-update{{ $loop->iteration }}" {{ $allowUpdate == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="update">
                                                <label for="switch-update{{ $loop->iteration }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg primary">
                                                <input type="checkbox" class="checkbox-action" data-user="{{$item_menu->id}}" id="switch-delete{{ $loop->iteration }}" {{ $allowDelete == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="delete">
                                                <label for="switch-delete{{ $loop->iteration }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline switch switch-lg primary">
                                                <input type="checkbox" class="checked-all" data-user="{{$item_menu->id}}" id="switch-checked{{ $loop->iteration }}" {{ $checkedAll ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="check-all">
                                                <label for="switch-checked{{ $loop->iteration }}"></label>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
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

        @include('dashboard.partials.footer')
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

    <script>
        $('#tableWithSearch tbody').on('click', '.checked-all', function () {
            let data
            let role_menu_id = $(this).attr('data-role-menu')
            let action = $(this).attr('data-action')
            let data_menu = $(this).attr('data-menu')
            if (!$(this).is(':checked')) {
                // do something if the checkbox is NOT checked
                data = {
                    allow_create: false,
                    allow_read:  false ,
                    allow_update: false,
                    allow_delete: false,
                    allow_view: false,
                    updatedBy: "{{session()->get('userId')}}",
                    deletedAt: true
                }
                updateRoleMenu(data, role_menu_id)
            } else {
                data = {
                    allow_create: true,
                    allow_read: true,
                    allow_update:  true,
                    allow_delete: true,
                    allow_view: true,
                    createdBy: "{{session()->get('userId')}}",
                    updatedBy: "{{session()->get('userId')}}",
                    RoleId: '{{ $role->id }}',
                    MenuId: data_menu,
                    deletedAt: false
                }
                role_menu_id == '' ? assignRoleMenu(data) : updateRoleMenu(data, role_menu_id)
            }
        })

        $('#tableWithSearch tbody').on('click', '.checkbox-action', function() {
            let data
            let role_menu_id = $(this).attr('data-role-menu')
            let action = $(this).attr('data-action')
            let data_menu = $(this).attr('data-menu')
            if(role_menu_id == '') {
                data = {
                    RoleId: '{{ $role->id }}',
                    allow_create: action == 'create' ? true : false,
                    allow_read: action == 'read' ? true : false,
                    allow_update: action == 'update' ? true : false,
                    allow_delete: action == 'delete' ? true : false,
                    allow_view: action == 'view' ? true : false,
                    MenuId: data_menu,
                    createdBy: "{{session()->get('userId')}}"
                }
                assignRoleMenu(data)
            } else {
                if(action == 'create') {
                    data = {
                        allow_create: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'read') {
                    data = {
                        allow_read: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'update') {
                    data = {
                        allow_update: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'delete') {
                    data = {
                        allow_delete: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                } else if(action == 'view') {
                    data = {
                        allow_view: !$(this).is(':checked') ? false : true,
                        menu_id: data_menu
                    }
                }
                data.updatedBy = "{{session()->get('userId')}}"
                updateRoleMenu(data, role_menu_id)
            }
        })

        function assignRoleMenu(data) {
            $.ajax({
                url: `{{ $base_url }}accessRights`,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    location.reload()
                },
            });
        }
        
        function updateRoleMenu(data, id) {
            $.ajax({
                url: `{{ $base_url }}accessRights/${id}`,
                type: 'PATCH',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    location.reload()
                },
            });
        }
    </script>
@endsection
