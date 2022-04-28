@extends('dashboard.partials.app')

@section('title', 'Dashboard')

@section('css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
    <input type="hidden" id="status" value="{{ Session::get('status') }}">

    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Today Attendance
                                
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $attendanceStatus == 'Clock In' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockIn))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')}}</div>
                                    <div class="card-stats-item-label">Clock In</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $attendanceStatus == 'Clock In' || $attendanceStatus == 'Clock Out' ? 'N/A' : \Carbon\carbon::parse(strtotime($attendanceData->clockOut))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')}}</div>
                                    <div class="card-stats-item-label">Clock Out</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->workLoadStatus}}</div>
                                    <div class="card-stats-item-label">Status</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Planning Activity</h4>
                            </div>
                            <div class="card-body" style="font-size:12pt">
                                {{ $attendanceStatus == 'Clock In' ? 'N/A' : $attendanceData->planningActivity}}
                            </div>
                            <div class="card-footer mt-2">
                                <a href="{{ $attendanceStatus == 'Clock In' ? route('attendance.create') : route('attendance.edit', $attendanceData->id) }}" class="btn {{ $attendanceStatus == 'Clock In' ? 'btn-primary' : 'btn-danger'}} {{ $attendanceStatus == 'Already Recorded' ? 'd-none' : ''}}">{{ $attendanceStatus == 'Clock In' ? 'New Attendance' : $attendanceStatus}}</a>
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
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>

    @if (Session::has('status'))
        <script>
            let status = document.getElementById("status").value;
            iziToast.success({
                title: `Success.`,
                message: `${status}`,
                position: 'topRight'
            });
        </script>
    @endif
@endsection

@push('active.dashboard')
    active
@endpush
