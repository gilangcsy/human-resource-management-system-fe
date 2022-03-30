@extends('dashboard.partials.app')

@section('title', 'User Management')

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
        <h1>User Management</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('user-management.send_invitational') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
							@csrf
                            <div class="d-flex">
                                <div class="form-group">
                                    <input type="email" name="email" value="" class="form-control" required autofocus autocomplete="off">
                                    <div class="invalid-feedback">Please fill in the email</div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary ml-2">
                                        Invite User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Is Verified</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $user->fullName }}</td>
                                            <td>{{ $user->email }}</td>
                                            {{-- <td>
                                                <img alt="image" src="{{ $devHostStorage }}service/{{$item->thumbnail}}"
                                                    width="150" data-toggle="tooltip" title="{{$item->thumbnail}}">
                                            </td> --}}
                                            <td>
                                                <a href="" class="badge {{ $user->isVerified == true ? 'badge-primary' : 'badge-danger' }}">
                                                    {{ $user->isVerified == true ? 'Yes' : 'No' }}
                                                </a>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('user-management.set_active', $user->id) }}" class="badge {{ $user->isActive == true ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $user->isActive == true ? 'Yes' : 'No' }}
                                                </a> --}}
                                                
                                                {{-- <div class="control-label">Toggle switch single</div> --}}
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox" {{ $user->isVerified == true ? 'checked' : '' }} class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    {{-- <span class="custom-switch-description">I agree with terms and conditions</span> --}}
                                                </label>
                                            </td>
                                            <td>
                                                <form action="/user-management/{{ $user->id }}/{{ session()->get('userId') }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-warning mt-3">
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
                title: `User management.`,
                message: `${status}`,
                position: 'topRight'
            });

        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `User management.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection
@push('active.user-management')
    active
@endpush