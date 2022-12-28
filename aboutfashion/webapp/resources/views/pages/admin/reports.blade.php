@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
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
                <li class="nav-item active">
                    <a class="nav-link" href="/admin-panel/reports">Reports</a>
                </li>
            </ul>
            <div class="col-6"></div>
            <div class="col-6 mb-3">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div id="reportsList">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Report ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Review ID</th>
                            <th scope="col">Description</th>
                            <th scope="col">Report Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            @if ($report->resolved == false)  
                                <tr>
                                    <th scope="row">{{ $report->id }}</th>
                                    <td>{{ $report->user_id }}</td>
                                    <td>{{ $report->review_id }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->created_at }}</td>
                                    <td><span class="badge bg-warning">Open</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-regular fa-envelope"></i>
                                            Close
                                        </button>
                                    </td>
                                </tr>
                            @else ( $report->resolved == true)
                                <tr>
                                    <th scope="row">{{ $report->id }}</th>
                                    <td>{{ $report->user_id }}</td>
                                    <td>{{ $report->review_id }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ substr($report['created_at'], 0, 10) }}</td>
                                    <td><span class="badge bg-success">Closed</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-regular fa-envelope-open"></i>
                                            Close
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection