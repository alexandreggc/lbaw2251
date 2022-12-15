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
            <!--
            <div id="promotionsList">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Discount</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion['discount'] }}%</td>
                                <td>{{ substr($promotion['start_date'], 0, 10) }}</td>
                                <td>{{ substr($promotion['final_date'], 0, 10) }}</td>
                                <td>-->
                                    <!--código de form action para delete promotion-->
                                    <!--<button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-pencil"></i>
                                        edit
                                    </button>
                                </td>
                                <td>-->
                                    <!--código de form action para delete promotion-->
                                    <!--<button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-regular fa-xmark"></i>
                                        delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>-->
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
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-regular fa-pencil"></i>
                                            edit
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-sm ms-3">
                                            <i class="fa-regular fa-xmark"></i>
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