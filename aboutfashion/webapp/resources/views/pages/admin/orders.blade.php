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
            <div class="row-12">
                <div class="accordion" id="accordion">
                    @foreach($orders as $order)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$order->id}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{$order->id}}" aria-expanded="true" 
                                        aria-controls="collapse{{$order->id}}">
                                    <div class="col-1">
                                        ID: {{ $order['id'] }}
                                    </div>
                                    @if ($order->status == "Completed")
                                        <div class="col-3">
                                            {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                            <span class="badge bg-success ms-3">Completed</span>
                                        </div>
                                    @else
                                        <div class="col-3">
                                            {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                            <span class="badge bg-info ms-3">{{$order->status }}</span>
                                        </div>
                                    @endif
                                </button>
                            </h2>
                            <div id="collapse{{$order->id}}" class="accordion-collapse collapse" 
                                aria-labelledby="heading{{$order->id}}" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-2">
                                            @foreach ($order->details as $details)
                                                <img src="{{ $details->product->images[0]->file }}" 
                                                    class="img-fluid" alt="Responsive image">
                                                <div class="pt-3 text-center"><strong>{{$details->product['name']}}</strong></div>
                                            @endforeach
                                        </div>
                                        <div class="col-9">
                                            <h4>Total Price:</h4>  {{$order->totalPrice($order['id'])}} €
                                            <br>
                                            <br>
                                            <strong>Order date:</strong>  {{ substr($order['date'], 0, 10) }}
                                        </div>
                                        <div class="col-1">
                                            <div class="row">
                                                <button type="submit" class="btn btn-warning btn-sm mb-3">
                                                    <i class="fa-regular fa-pencil"></i>
                                                    edit status
                                                </button>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary btn-sm mb-3">
                                                    <i class="fa-regular fa-pencil"></i>
                                                    edit
                                                </button>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-regular fa-xmark"></i>
                                                    delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--
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
                                            {{ substr($order['date'], 0, 10) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col">
                                            {{ $order->totalPrice($order['id']) }}
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
                -->
            </div>
        </div>
    </div>
@endsection