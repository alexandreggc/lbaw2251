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
                    <a class="nav-link active" href="/admin-panel/products">Products</a>
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
            <div class="row pt-3 pb-3">
                <div class="col-2">
                    <button type="button" class="btn btn-primary">
                        <i class="fa-regular fa-plus"></i>
                    </button>
                </div>
                <div class="col"></div>
                <div class="col-6 pb-3">
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="text" placeholder="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <!--
            <div id="productsList">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['price'] }}</td>
                                <td>-->
                                    <!--código de form action para edit product-->
                                    <!--<button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-pencil"></i>
                                        edit
                                    </button>
                                <td>-->
                                    <!--código de form action para delete product-->
                                    <!--<button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-regular fa-xmark"></i>
                                        delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> -->
            <div class="accordion" id="accordion">
                @foreach($products as $product)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$product->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$product->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$product->id}}">
                                <div class="col-1 pe-3">
                                    <img src="{{ $product->images[0]->file }}" alt="product image" 
                                        class="img-fluid">
                                </div>
                                <div class="col">
                                    <strong>Name: </strong>{{ $product->name }}
                                    <br>
                                    <br>
                                    <strong>Price: </strong>{{ $product->price }}
                                </div>
                                <div class="col-1 ps-3">
                                    <div class="row pb-3"> 
                                        <a href="#">
                                            <i class="fa-regular fa-pencil"></i>
                                            edit
                                        </a>
                                    </div>
                                    <div class="row pt-3">
                                        <a href="#">
                                            <i class="fa-regular fa-delete-left"></i>
                                            delete
                                        </a>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$product->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$product->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <strong>Description:</strong> {{ $product->description }}
                                <br>
                                <strong>Classification:</strong> {{ $product->avg_classification }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection