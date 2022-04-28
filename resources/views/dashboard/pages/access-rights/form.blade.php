@extends('dashboard.partials.app')

@section('title', 'Access Rights')

@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet"
    href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
@endsection

@section('content')
<input type="hidden" id="status" value="{{Session::get('status')}}">
<input type="hidden" id="error" value="{{Session::get('error')}}">
<section class="section">
    <div class="section-header">
        <h1>Access Rights {{ $role->name }}</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
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
                                                if($item_menu->id == $item->menu_id) {
                                                    $allowCreate = $item->allow_create;
                                                    $allowRead = $item->allow_read;
                                                    $allowDelete = $item->allow_delete;
                                                    $allowUpdate = $item->allow_update;
                                                    $isExists = $item->id;
                                                }

                                                if($allowCreate && $allowRead && $allowUpdate && $allowDelete == true) {
                                                    $checkedAll = true;
                                                }
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <b>{{ $item_menu->master_menu_name }}</b>
                                                <br>
                                                {{ $item_menu->name }}
                                            </td>
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input checkbox-action" {{ $allowCreate == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="create">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input checkbox-action" {{ $allowRead == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="read">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input checkbox-action" {{ $allowUpdate == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="update">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input checkbox-action" {{ $allowDelete == true ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="delete">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input checked-all" {{ $checkedAll ? 'checked' : '' }} data-menu="{{ $item_menu->id }}" data-role-menu="{{ $isExists }}" data-action="check-all">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
    @if (Session::has('status'))
        <script>
            let status = document.getElementById('status').value
            iziToast.success({
                title: `Access Rights.`,
                message: `${status}`,
                position: 'topRight'
            });

        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Access Rights.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif

    <script>
        $('#table-1 tbody').on('click', '.checked-all', function () {
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
                    updatedBy: "{{session()->get('userId')}}"
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
                    MenuId: data_menu
                }
                role_menu_id == '' ? assignRoleMenu(data) : updateRoleMenu(data, role_menu_id)
            }
        });
        
        $('#table-1 tbody').on('click', '.checkbox-action', function () {
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

@push('active.access-rights')
    active
@endpush