@extends('dashboard.partials.app')

@section('title', 'Leave')

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
        <h1>Leave</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('leave.create') }}" class="btn btn-primary">Add New Leave</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>Emp. ID</th>
                                        <th>Emp. Name</th>
                                        <th>Period</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leave as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->requester_emp_id }}</td>
                                            <td>{{ $item->requester_name }}</td>
                                            <td>{{ \Carbon\carbon::parse(strtotime($item->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }} - {{ \Carbon\carbon::parse(strtotime($item->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                @php
                                                    $badge = 'badge-warning';
                                                    if($item->last_status == 'Approved') {
                                                        $badge = 'badge-success';
                                                    } else if($item->last_status == 'Rejected') {
                                                        $badge = 'badge-danger';
                                                    }
                                                @endphp
                                                <span class="badge {{ $badge }}">{{ $item->last_status }}</span>
                                                </td>
                                            <td class="d-flex">
                                                <a href="{{ route('leave.edit', $item->id) }}" class="btn btn-md btn-warning">
                                                    <i class="fa fa-pen-square"></i>
                                                </a>
                                                <a href="{{ route('leave.show', $item->id) }}" class="btn btn-md btn-primary ml-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <form action="{{route('leave.destroy', $item->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-md btn-danger ml-2" onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
                title: `Leave Type.`,
                message: `${status}`,
                position: 'topRight'
            });

        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Leave.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection

@push('active.leave')
    active
@endpush