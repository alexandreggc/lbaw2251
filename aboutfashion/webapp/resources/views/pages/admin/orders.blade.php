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
                        @if (in_array($order->status, ["Completed", "Pending", "Cancelled", "In Progress"]))
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
                                    @elseif ($order->status == "Pending")
                                        <div class="col-3">
                                            {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                            <span class="badge bg-warning ms-3">Completed</span>
                                        </div>
                                    @elseif ($order->status == "Cancelled")
                                        <div class="col-3">
                                            {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                            <span class="badge bg-danger ms-3">Completed</span>
                                        </div>
                                    @elseif ($order->status == "In Progress")
                                        <div class="col-3">
                                            {{ $order->user['first_name'] . ' ' . $order->user['last_name'] }}
                                            <span class="badge bg-info ms-3">{{$order->status }}</span>
                                        </div>
                                    @else <!-- $order->status == "Shopping Cart" -->
                                        @continue
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
                                                    &nbsp;
                                                    edit status
                                                </button>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary btn-sm mb-3">
                                                    <i class="fa-regular fa-pencil"></i>
                                                    &nbsp;
                                                    edit
                                                </button>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-regular fa-xmark"></i>
                                                    &nbsp;
                                                    delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection