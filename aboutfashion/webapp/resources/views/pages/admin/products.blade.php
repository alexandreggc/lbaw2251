@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="p-3">Products</h2>
    </div>
    <div class="row mb-5">
        <!--<ul class="nav nav-pills m-3">
            <li class="nav-item">
                <a class="nav-link" href="/admin-panel/users">Users</a>
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
        </ul>-->
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
                    Add Product
                </button>
            </div>
        </div>
        <div class="accordion" id="accordion">
            @foreach ($products as $product)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $product->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $product->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $product->id }}">
                            <div class="col-1 pe-3">
                                <img src="{{ $product->images[0]->file }}" alt="product image" class="img-fluid">
                            </div>
                            <div class="col">
                                <strong>Name: </strong>{{ $product->name }}
                                <br>
                                <br>
                                <strong>Price: </strong>{{ $product->price }}
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $product->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $product->id }}" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col">
                                    <strong>Description:</strong> {{ $product->description }}
                                    <br>
                                    <strong>Classification:</strong> {{ is_null($product->avg_classification) ? 'No reviews yet' : $product->avg_classification }}
                                </div>
                                <div class="col-1">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary btn-sm mb-3">
                                            <i class="fa-solid fa-pencil"></i>
                                            &nbsp;
                                            edit
                                        </button>
                                    </div>
                                    <div class="row">
                                        <button type="submit" class="btn btn-danger btn-sm pe-1">
                                            <i class="fa-solid fa-xmark"></i>
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
{{$products->links()}}
@endsection
