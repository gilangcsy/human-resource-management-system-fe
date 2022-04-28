@extends('dashboard.partials.app')

@section('title', 'Menu Management')

@section('css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
    <input type="hidden" id="status" value="{{ Session::get('status') }}">
    <input type="hidden" id="error" value="{{ Session::get('error') }}">
    <section class="section">
        <div class="section-header">
            <h1>Menu Management</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('menu.create') }}" class="btn btn-primary">Add New Menu</a>
                        </div>
                        @foreach ($lists as $list)
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped sortable-table-custom" id="sortable-table-custom">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" style="width: 200px">
                                                        {{ $list['name'] }}
                                                    </th>
                                                    <th>Sub Menu</th>
                                                    <th class="d-flex">
                                                        <a href="{{ route('menu.edit', $list['id']) }}" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-pen-square"></i>
                                                        </a>
                                                        <form action="{{route('menu.destroy', $list['id'])}}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @if ($list['childs'])
                                                @foreach ($list['childs'] as $child)
                                                    <tr data-index="{{ $child['id'] }}" data-position="{{ $child['position'] }}">
                                                        <td>
                                                            <div class="sort-handler">
                                                                <i class="fas fa-th"></i>
                                                            </div>
                                                        </td>
                                                        <td>{{ $child['name'] }}</td>
                                                        <td class="d-flex">
                                                            <a href="{{ route('menu.edit', $child['id']) }}" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-pen-square"></i>
                                                            </a>
                                                            <form action="{{route('menu.destroy', $child['id'])}}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure?')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/page/components-table.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
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
        $('#sortable-table-custom tbody').sortable({
            handle: '.sort-handler',
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('updated')
                    }
                })
                saveNewPositions();
            }
        })

        $(".sortable-table-custom").dataTable({
            "dom": 'frtip',
            "columnDefs": [
                {
                    "sortable": false,
                    "targets": [0]
                }
            ]
        })

        function saveNewPositions() {
            let positions = []
            $('.updated').each(function () {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')])
                $(this).removeClass('updated')
            })

            $.ajax({
                url: '{{ $base_url }}master/menu/newPositions',
                method: 'POST',
                dataType: 'TEXT',
                data: {
                    positions: positions
                }, success: function (response) {
                    location.reload()
                }
            })
        }
    </script>
@endsection

@push('active.menu')
    active
@endpush
