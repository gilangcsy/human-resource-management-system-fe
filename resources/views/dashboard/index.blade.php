@extends('dashboard.partials.app')

@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
@endsection

@section('content')
<input type="hidden" id="status" value="{{Session::get('status')}}">

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <form id="payment-form" method="post">
                    @csrf
                    <input type="hidden" name="result_type" id="result-type" value=""></div>
                    <input type="hidden" name="result_data" id="result-data" value=""></div>
                </form>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<!-- JS Libraies -->
<script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>

@if (Session::has('status'))
<script>
    let status = document.getElementById("status").value;
    iziToast.success({
        title: `${status}. `,
        message: 'You are logged as an Admin! :)',
        position: 'topRight'
    });
</script>

@endif
@endsection

@push('dashboard.index')
	
@endpush
