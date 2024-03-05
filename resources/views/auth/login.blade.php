@extends('auth.app')
@section('title', 'Login')    
@section('content')
<h1 class="text-primary">LearnHub</h1>
<div class="container w-25">
    <h3 class="text-center">Login</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
        <div>
            Don't have any account? <a class="text-primary" href="{{ route('register') }}">Click here</a> to register.
        </div>
    </form>
</div>

{{-- @if(Auth::check())
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endif --}}

@endsection
