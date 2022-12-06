@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('forgot.password.action') }}">
        {{ csrf_field() }}

        @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
        @else
        @endif


        <label for="email">E-Mail Address</label>
        <input id="email" type="email" name="email" value="" required>

        <button type="submit">
            Send
        </button>
    </form>
@endsection
