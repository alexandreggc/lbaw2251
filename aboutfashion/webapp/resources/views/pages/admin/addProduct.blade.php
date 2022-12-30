@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Products</h2>
        </div>
        <div class="row pb-3">
            <div class="col-1">
                <a href="/admin-panel/products">
                    <i class="fa-regular fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="col">
                <h3>Add New Product</h3>
            </div>
        </div>
        <div class="row pt-3">
            
            <form method="POST" action="{{ route('storeProduct') }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="productSelect" class="form-label mt-4"></label>
                    <select class="form-select" id="categorySelect" name="id_category" onchange="showCategory()"> <!-- ATENÇÃO AO ONCHANGE -->
                        <option>Select a category </option>
                        @foreach ($categorys as $category)
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
                <div class="modal-footer">
                    <span class="error-text me-auto" style="color:red"> </span>
                    <button type="submit" class="btn btn-primary reg">Save</button>
                </div>
            </form>

        </div>
    </div>
@endsection