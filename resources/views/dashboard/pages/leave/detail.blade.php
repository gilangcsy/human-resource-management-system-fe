@extends('dashboard.partials.app')

@section('title', 'Leave')

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
            <h1>Detail Leave Application</h1>
        </div>

        <div class="section-body">

            <div class="row">
                {{-- <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $leave->description }}</h4>
                        </div>
                        <div class="card-body">
                            <p>Card <code>.card-primary</code></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="wizard-steps">
                        <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="wizard-step-label">
                                Order Placed
                            </div>
                        </div>
                        <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="wizard-step-label">
                                Payment Completed
                            </div>
                        </div>
                        <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="wizard-step-label">
                                Product Shipped
                            </div>
                        </div>
                        <div class="wizard-step wizard-step-success">
                            <div class="wizard-step-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="wizard-step-label">
                                Order Completed
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>
                                                Approver Name
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $leave->approver_one_name }}</td>
                                            <td>
                                                <span class="badge {{ $leave->approval_one_status == 'Approved' ? 'badge-success' : $leave->approval_one_status == 'Rejected' ? 'badge-danger' : 'badge-warning' }}">{{ $leave->approval_one_status  }}</span>
                                            </td>
                                        </tr>
                                        @if ($leave->approver_two != null)
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $leave->approver_two_name }}</td>
                                                <td>
                                                    <span class="badge {{ $leave->approval_two_status == 'Approved' ? 'badge-success' : $leave->approval_two_status == 'Rejected' ? 'badge-danger' : 'badge-warning' }}">{{ $leave->approval_two_status  }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($leave->approver_three != null)
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $leave->approver_three_name }}</td>
                                                <td>
                                                    <span class="badge {{ $leave->approval_three_status == 'Approved' ? 'badge-success' : $leave->approval_three_status == 'Rejected' ? 'badge-danger' : 'badge-warning' }}">{{ $leave->approval_three_status  }}</span>
                                                </td>
                                            </tr>
                                        @endif
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
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>

    @if (Session::has('status'))
        <script>
            iziToast.success({
                let status = document.getElementById('status').value
                title: `Leave Type.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            iziToast.error({
                let error = document.getElementById('error').value
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
