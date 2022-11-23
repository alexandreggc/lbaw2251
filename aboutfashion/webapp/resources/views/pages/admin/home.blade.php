@extends('layouts.app')
<ul id="profile-tab" class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" data-bs-toggle="tab" href="#information" aria-selected="false" role="tab" tabindex="-1">Information</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#addresses" aria-selected="true" role="tab">Users</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#orders" aria-selected="true" role="tab">Orders, History and
            Details</a>
    </li>
</ul>
@section('content')
@endsection
