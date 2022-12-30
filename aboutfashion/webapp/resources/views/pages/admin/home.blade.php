@extends('layouts.admin')

@php
    $admin = Auth::guard('admin')->user();
@endphp

@section('content')
    <div class="container">
        <div class="row mb-3">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/promotions">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/reports">Reports</a>
                </li>
            </ul>
        </div>
        <h2>Welcome {{ $admin['first_name'] . ' ' . $admin['last_name'] }}!</h2>
        <h4>{{ $admin['role'] }}</h4>
        <div class="row pt-4">
            <div class="col">
                <div class="row">
                    <div class="col-4">
                        <div class="row">    
                            <button type="button" class="btn btn-outline-primary btn-lg">Users</button>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-lg">Products</button>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-4">
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-lg">Promotions</button>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-lg">Orders</button>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-4">
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-lg">Reviews</button>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="row">
                            <button type="button" class="btn btn-outline-primary btn-lg">Reports</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-primary mb-3">
                    <h3 class="card-header">Notification Center</h3>
                    <div class="card-body">
                        <h5 class="card-title">These are your notifications!</h5>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                    </svg>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="row">
            <h2>Welcome {{ $admin['first_name'] . ' ' . $admin['last_name'] }}!</h2>
            <h4>{{ $admin['role'] }}</h4>
            <div id="personalInfo">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Role
                        <span>{{ $admin['role'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Social title
                        <span>{{ $admin['gender']==='M'? 'Mr.' : ($admin['gender']==='F'? 'Ms.' : 'Other')}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        First name
                        <span>{{ $admin['first_name'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Second name
                        <span>{{ $admin['last_name'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Gender
                        @if (is_null($admin['gender']))
                            <span>Not Defined</span>
                        @elseif ($admin['gender'] == 'M')
                            <span>Male</span>
                        @elseif ($admin['gender'] == 'F')
                            <span>Female</span>
                        @else
                            <span>Other</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Email
                        <span>{{ $admin['email'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Birth Date
                        <span>{{ substr($admin['birth_date'], 0, 10) }}</span>
                    </li>
                </ul>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Profile Picture</h5>
                    </div>
                    <img src={{ $admin->image->file }} id="profilePic" width="300px" height="300px" />
                </div>
            </div>
        </div>-->
    </div>
@endsection