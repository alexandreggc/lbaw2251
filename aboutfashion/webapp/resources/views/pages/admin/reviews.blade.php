@extends('layouts.admin')

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
            <div class="accordion" id="accordion">
                @foreach($reviews as $review)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$review->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$review->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$review->id}}">
                                <div class="col-1 pe-3">
                                    <img src="{{ $review->product->images[0]->file }}" alt="product image" 
                                        class="img-fluid">
                                </div>
                                <div class="col">
                                    <strong>Review ID: </strong>{{ $review->id }}
                                    <br>
                                    <br>
                                    <strong>Product: </strong>{{ $review->product->name }}
                                    <br>
                                    <br>
                                    <strong>User: </strong>{{ $review->user['first_name'] . ' ' . $review->user['last_name'] }}
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$review->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$review->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col">
                                        <strong>Evaluation:</strong> {{ $review->evaluation }}
                                        <br>
                                        <strong>Title:</strong> {{ $review->title }}
                                        <br>
                                        <strong>Description:</strong> {{ $review->description }}
                                        <br>
                                        <strong>Date:</strong> {{ substr($review['date'], 0, 10) }}
                                    </div>
                                    <div class="col-1">
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
                @endforeach
            </div>
        </div>
    </div>
@endsection