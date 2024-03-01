@extends('auth.app')
@section('title', 'Register')
@section('content')
    <div class="container w-25">
        <h1>Verify OTP</h1>
        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $user_email }}">
            <div class="form-group mb-3">
                <label for="otp">OTP</label>
                <input id="otp" type="number" class="form-control" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Verify</button>
        </form>
        <form action="{{ route('resend.otp') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $user_email }}">
            <div>
                Don't receive yet? <button class="btn text-primary" type="submit">Resend OTP</button>.
            </div>
        </form>
    </div>
@endsection
