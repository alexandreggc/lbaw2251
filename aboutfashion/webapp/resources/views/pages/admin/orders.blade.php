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
                    <a class="nav-link active" href="/admin-panel/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/reviews">Reviews</a>
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
            <div id="ordersList">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order['id'] }}</th>
                                <td>
                                    <div class="col">
                                        {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        {{ substr($order['order_date'], 0, 10) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        {{ $order['total_price'] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        {{ $order['status'] }}
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-pencil"></i>
                                        edit
                                    </button>
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