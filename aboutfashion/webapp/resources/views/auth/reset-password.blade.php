@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('reset.password.action') }}">
        @csrf

        @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
        @else
        @endif

        <label for="password">Password</label>
        <input name="password" type="password" id="password" placeholder="Password" required>

        <label for="password">Confirm Password</label>
        <input name="password_confirmation" type="password" id="password-confirm" placeholder="Confirm Password" required>
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request()->email }}">

        <button type="submit" class="btn btn-purple btn-lg customBtn">
            Reset Password
        </button>
    </form>
@endsection
