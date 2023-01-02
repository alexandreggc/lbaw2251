@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3 pb-5">Products</h2>
        </div>
        <div class="row">
            <div class="col-1">
                <a href="/admin-panel/products">
                    <i class="fa-solid fa-arrow-left fa-2x"></i>
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
                        <div class="row">
                            <div class="col-4 pt-4">
                                <div class="card">
                                    <img src="{{ $product->images[0]->file }}" alt="product image" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col">
                                <!-- Category -->
                                <label for="categorySelect" class="form-label mt-4">Category</label>
                                <select class="form-select" id="categorySelect" name="id_category" value="{{$product['id_category']}}" onchange="showCategory()"> <!-- ATENÇÃO AO ONCHANGE -->
                                    <option value="{{ $product['id_category'] }}" selected>{{ $product->category->name }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                </select>
                                <!-- Name -->
                                <label for="name" class="form-label mt-4">Name</label>
                                <input type="text" class="form-control" id="product_name" value="{{$product->name}}" name="name">
                                <!-- Description -->
                                <label for="description" class="form-label mt-4">Description</label>
                                <input type="text" class="form-control" id="product_description" value="{{$product->description}}" name="description">
                                <!-- Price -->
                                <label for="price" class="form-label mt-4">Price</label>
                                <input type="number" class="form-control" id="product_price" value="{{$product->price}}" name="price">
                                <!-- Images -->
                                <label for="formFile" class="form-label mt-4">New images input</label>
                                <input class="form-control" type="file" id="formFile"> <!-- multiple name="images[]" -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-5 pe-0">
                        <span class="error-text me-auto" style="color:red"> </span>
                        <button type="submit" class="btn btn-primary reg btn-lg">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection