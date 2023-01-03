@extends('layouts.app')
@section('content')
    @csrf
    @php 
    echo($notifications);
    @endphp

   
@endsection
