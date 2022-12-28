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
                    <a class="nav-link active" href="/admin-panel/promotions">Promotions</a>
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
            <div class="col-6"></div>
            <div class="col-6">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-outline-primary mb-4">
                        <i class="fa-regular fa-plus"></i>
                        Add Promotion
                    </button>
                </div>
            </div>
            <div class="accordion" id="accordion">
                @foreach($promotions as $promotion)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$promotion->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$promotion->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$promotion->id}}">
                                <div class="col">
                                    <strong>Promotion ID: </strong>{{ $promotion->id }}
                                    <br>
                                    <br>
                                    <strong>Discount: </strong>{{ $promotion->discount }} %
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$promotion->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$promotion->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col">
                                        <strong>Start Date: </strong>{{ substr($promotion['start_date'], 0, 10) }}
                                        <br>
                                        <strong>Final Date: </strong>{{ substr($promotion['final_date'], 0, 10) }}
                                    </div>
                                    <div class="col-1">
                                        <div class="row">
                                            <button type="submit" class="btn btn-primary btn-sm mb-3">
                                                <i class="fa-regular fa-pencil"></i>
                                                &nbsp;
                                                edit
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn btn-danger btn-sm pe-1">
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
                @endforeach
            </div>
        </div>
    </div>
@endsection