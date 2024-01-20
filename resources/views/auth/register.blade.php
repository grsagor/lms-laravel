@extends('auth.app')
@section('content')
    <div class="container w-25">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                        autofocus>
                </div>
                <div class="form-group col">
                    <label for="role">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                    required>
            </div>
            <div class="row mb-3">
                <div class="form-group col">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group col">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
            <div>
                Already have an account? <a href="{{ route('login') }}">Click here</a> to login.
            </div>
        </form>
    </div>
@endsection
