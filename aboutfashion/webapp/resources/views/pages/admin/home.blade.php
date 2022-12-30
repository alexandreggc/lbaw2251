@extends('layouts.admin')

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
        <div class="row">
            <h2>Personal Information</h2>
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
        </div>
    </div>
@endsection