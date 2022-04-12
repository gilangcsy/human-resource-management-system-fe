@extends('dashboard.partials.app')

@section('css')
	<link rel="stylesheet" href="{{asset('assets/modules/jquery-selectric/selectric.css')}}">
	<link rel="stylesheet" href="{{asset('assets/modules/summernote/summernote-bs4.css')}}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Management</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit User</h2>
        <p class="section-lead">
			You can edit user here.
		</p>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4>Input Text</h4>
                    </div> --}}
                    <div class="card-body">
                        <form action="{{ route('user-management.update', $user->id) }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
							@csrf
                            @method('patch')
                            @include('dashboard.user-management._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
	<script src="{{asset('assets/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
	<script src="{{asset('assets/modules/summernote/summernote-bs4.js')}}"></script>
@endsection

@push('active.user-management')
    active
@endpush