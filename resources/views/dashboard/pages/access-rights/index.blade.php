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
        <h1>Access Rights</h1>
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
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('access-rights.edit', $item->id) }}" class="btn btn-warning">
                                                    <i class="fa fa-pen-square"></i>
                                                </a>
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
@endsection

@push('active.access-rights')
    active
@endpush