
@extends('auth.partials.app-2')

@section('title', 'Set New Password')
@section('page-title', 'Set New Password')
@section('description', "Set a new password for your account.")

@section('form')
    <form method="POST" action="{{ route('auth.set-new-password') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="token" value="{{ $checkToken->data->token }}">
                <div class="form-group form-group-default is-invalid">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Type your new password"
                        class="form-control" required>
                </div>
                <div class="form-group form-group-default">
                    <label>Confirm your new password</label>
                    <input type="password" name="password_confirmation" placeholder="Type your new password"
                        class="form-control" required>
                </div>
            </div>
        </div>
        <button aria-label="" class="btn btn-primary btn-cons m-t-10" type="submit">
            Set Password
        </button>
    </form>
@endsection