@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Users</h2>
        </div>
        <!--
        <div class="row mb-3">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin-panel/users">Users</a>
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
        -->
        <div class="row pb-3">
            <div class="col-1">
                <a href="/admin-panel/users">
                    <i class="fa-regular fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="col">
                <h3>{{ $user['first_name'] . ' ' . $user['last_name'] }} Purchase History</h3>
            </div>
        </div>
        <div class="row pt-3">
            <div class="cards_flex">
                @foreach ($user->orders as $order)
                    <div class="card border-primary mb-3" style="max-width: 23rem;">
                        <div class="card-header">Order #{{ $order['id'] }}</div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Date
                                    <span>{{ substr($order['date'], 0, 10) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Status
                                    <span class="badge bg-primary">{{ $order['status'] }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Address Name
                                    <span>{{ isset($order['address']['name']) ? $order['address']['name'] : 'Not Defined' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Card Number
                                    <span>{{ isset($order['card']['number']) ? $order['card']['number'] : 'Not Defined' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Products
                                    <span>
                                        @foreach ($order->details as $detail)
                                            {{ $detail->product['name'] }} <br>
                                        @endforeach
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Price
                                    <span>{{ $order->totalPrice($order['id']) }}</span>
                                </li>
                            </ul>
                            <a href="/order/{{ $order['id'] }}" class="card-link">More Details</a>
                            <!-- Permitir visualização do ADMIN-->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection