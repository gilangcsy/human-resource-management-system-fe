
@extends('auth.partials.app-2')

@section('title', 'Forgot Password')
@section('page-title', 'Forgot your password?')
@section('description', "Type your email below, and we will send you an email to confirm that it's really you.")

@section('form')
    <form method="POST" action="{{ route('auth.forgot-password-sent') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="example@ids.co.id"
                        class="form-control" required>
                </div>
            </div>
        </div>
        <button aria-label="" class="btn btn-primary btn-cons m-t-10" type="submit">
            Send me an email
        </button>
    </form>
@endsection