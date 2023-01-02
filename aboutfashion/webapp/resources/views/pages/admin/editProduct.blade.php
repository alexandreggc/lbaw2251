@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3 pb-5">Products</h2>
        </div>
        <div class="row">
            <div class="col-1">
                <a href="/admin-panel/products">
                    <i class="fa-regular fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="col">
                <h3>Edit Informations of {{ $product['name'] }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <form method="POST" action="{{ route('updateProduct', ['id' => $product->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="categorySelect" class="form-label mt-4"></label>
                        <select class="form-select" id="categorySelect" name="id_category" onchange="showCategory()"> <!-- ATENÇÃO AO ONCHANGE -->
                            <option>Select a category </option>
                            @foreach ($categories as $category)
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label mt-4">Name</label>
                        <input type="text" class="form-control" id="product_name" value="{{$product->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label mt-4">Description</label>
                        <input type="text" class="form-control" id="product_description" value="{{$product->description}}" name="description">
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label mt-4">Price</label>
                        <input type="number" class="form-control" id="product_price" value="{{$product->price}}" name="price">
                    </div>
                    <div class="modal-footer p-5 pe-0">
                        <span class="error-text me-auto" style="color:red"> </span>
                        <button type="submit" class="btn btn-primary reg">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection