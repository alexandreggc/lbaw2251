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
            <!--
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
            -->
            <div class="accordion" id="accordion">
                @foreach($reviews as $review)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$review->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$review->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$review->id}}">
                                <div class="col">
                                    <strong>Review ID: </strong>{{ $review->id }}
                                    <br>
                                    <br>
                                    <strong>Product: </strong>{{ $review->product->name }}
                                    <br>
                                    <br>
                                    <strong>User: </strong>{{ $review->user['first_name'] . ' ' . $review->user['last_name'] }}

                                    <!--
                                    Review ID: <strong>{{ $review->id }}</strong>
                                    <br>
                                    <br>
                                    Product: <strong{{ $review->product->name }}></strong>
                                    <br>
                                    <br>
                                    User: <strong>{{ $review->user['first_name'] . ' ' . $review->user['last_name'] }}</strong>
                                    -->
                                </div>
                                
                                <div class="col-1 ps-3">
                                    <a href="#">
                                        <i class="fa-regular fa-delete-left"></i>
                                        delete
                                    </a>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$review->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$review->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <strong>Evaluation:</strong> {{ $review->evaluation }}
                                <br>
                                <strong>Title:</strong> {{ $review->title }}
                                <br>
                                <strong>Description:</strong> {{ $review->description }}
                                <br>
                                <strong>Date:</strong> {{ substr($review['date'], 0, 10) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection