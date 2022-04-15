@extends('dashboard.partials.app')

@section('title', 'Approval Authorization')

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
        <h1>Approval Authorization</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('approval-authorization.create') }}" class="btn btn-primary">Add New Approval Authorization</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>Role Name</th>
                                        <th>Template Name</th>
                                        <th>Template Type</th>
                                        <th>Approver</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvalAuthorization as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->role_name }}</td>
                                            <td>{{ $item->approval_template_name }}</td>
                                            <td>{{ $item->approval_template_type }}</td>
                                            <td>
                                                1. {{ $item->approver_one_name }}
                                                <br>
                                                2. {{ $item->approver_two_name }}
                                                <br>
                                                3. {{ $item->approver_three_name }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('approval-authorization.edit', $item->id) }}" class="btn btn-warning">
                                                    <i class="fa fa-pen-square"></i>
                                                </a>
                                                <form action="{{route('approval-authorization.destroy', $item->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')">
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
                title: `Approval Authorization.`,
                message: `${status}`,
                position: 'topRight'
            });

        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Approval Authorization.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection

@push('active.approval-authorization')
    active
@endpush