@extends('dashboard.partials.app')

@section('title', 'Approval Leave')

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
            <h1>Approval Leave</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                        aria-controls="home" aria-selected="true">Active Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                        role="tab" aria-controls="profile" aria-selected="false">History</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <form action="{{ route('approval-leave.action') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary approve">Approve</button>
                                        <button type="submit" class="btn btn-danger reject">Reject</button>
                                        <input type="hidden" name="isApproved" id="isApproved" value="">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-striped table-sm" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    data-checkbox-role="dad" class="custom-control-input"
                                                                    id="checkbox-all">
                                                                <label for="checkbox-all"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Emp. ID</th>
                                                        <th>Emp. Name</th>
                                                        <th>Period</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leaves as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="custom-checkbox custom-control">
                                                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-{{ $loop->iteration }}" name="action[]" value="{{ $item->id }}">
                                                                    <label for="checkbox-{{ $loop->iteration }}" class="custom-control-label">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->requester_emp_id }}</td>
                                                            <td>{{ $item->requester_name }}</td>
                                                            <td>{{ \Carbon\carbon::parse(strtotime($item->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                                -
                                                                {{ \Carbon\carbon::parse(strtotime($item->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                            </td>
                                                            <td>{{ $item->description }}</td>
                                                            <td>
                                                                @php
                                                                    $badge = 'badge-warning';
                                                                    if ($item->last_status == 'Approved') {
                                                                        $badge = 'badge-success';
                                                                    } elseif ($item->last_status == 'Rejected') {
                                                                        $badge = 'badge-danger';
                                                                    }
                                                                @endphp
                                                                <span
                                                                    class="badge {{ $badge }}">{{ $item->last_status }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-sm" id="table-1">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($history as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->requester_emp_id }}</td>
                                                        <td>{{ $item->requester_name }}</td>
                                                        <td>{{ \Carbon\carbon::parse(strtotime($item->start_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                            -
                                                            {{ \Carbon\carbon::parse(strtotime($item->end_date))->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                                                        </td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>
                                                            @php
                                                                $badge = 'badge-warning';
                                                                if ($item->last_status == 'Approved') {
                                                                    $badge = 'badge-success';
                                                                } elseif ($item->last_status == 'Rejected') {
                                                                    $badge = 'badge-danger';
                                                                }
                                                            @endphp
                                                            <span class="badge {{ $badge }}">
                                                                {{ $item->last_status }}
                                                            </span>
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

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    @if (Session::has('status'))
        <script>
            let status = document.getElementById('status').value
            iziToast.success({
                title: `Approval Leave.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            let error = document.getElementById('error').value
            iziToast.error({
                title: `Approval Leave.`,
                message: `${error}`,
                position: 'topRight'
            });
        </script>
    @endif


    <script>
        let isApproved = document.getElementById('isApproved')
        $( '.approve').click(function() {
            isApproved.value = 'true'
        });

        $( '.reject').click(function() {
            isApproved.value = 'false'
        });

    </script>
@endsection

@push('active.approval-leave')
    active
@endpush
