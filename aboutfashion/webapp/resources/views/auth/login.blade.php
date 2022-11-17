@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="email" class="form-label mt-4">Email address</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control"  placeholder="Enter email">
      @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
      @endif
    </div>
    <div class="form-group">
      <label for="password" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
      @endif
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault">
            Remember Me
        </label>
      </div>
    <button type="submit" class="btn btn-primary">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection
