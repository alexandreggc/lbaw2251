@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel">Users</a>
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
                    <a class="nav-link active" href="/admin-panel/reviews">Reviews</a>
                </li>
                <li class="nav-item">
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
            <div id="reviewsList">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Review ID</td>
                            <td>Product</td>
                            <td>User</td>
                            <td>Evaluation</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Date</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>{{ $review->product->name }}</td>
                                <td>{{ $review->user['first_name'] . ' ' . $review->user['last_name'] }}</td>
                                <td>{{ $review->evaluation }}</td>
                                <td>{{ $review->title }}</td>
                                <td>{{ $review->description }}</td>
                                <td>{{ substr($review['date'], 0, 10) }}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-regular fa-xmark"></i>
                                        delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection