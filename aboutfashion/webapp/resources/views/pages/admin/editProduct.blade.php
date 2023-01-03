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
        <div class="row pb-3">
            <h3>Edit promotions</h3>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Final Date</th>
                        <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->promotions as $promotion)
                            <tr>
                                <th scope="row">{{$promotion->id}}</th>
                                <td>{{$promotion->discount}} %</td>
                                <td>{{$promotion->start_date}}</td>
                                <td>{{$promotion->final_date}}</td>
                                <td>
                                    <form method="POST" action="{{ route('removeProductPromotion', ['id' => $product->id]) }}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id_promotion" value="{{$promotion->id}}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
            <div class="col">
                <form method="POST" action="{{ route('addProductPromotion', ['id' => $product->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <!-- Promotions -->
                        <label for="promotionSelect" class="form-label mt-4">Promotions</label>
                        <select class="form-select" id="promotionSelect" name="id_promotion" onchange="showPromotion()"> <!-- ATENÇÃO AO ONCHANGE -->
                            <option>Select a new promotion to apply</option>
                            @foreach ($promotions as $promotion)
                                @php
                                    $formatStartDate = date('Y-m-d', strtotime($promotion->start_date));
                                    $formatFinalDate = date('Y-m-d', strtotime($promotion->final_date));
                                @endphp
                                <option value="{{$promotion['id']}}">{{$promotion['discount']}} %, starts: {{$formatStartDate}}, ends: {{$formatFinalDate}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer p-5 pe-0">
                        <span class="error-text me-auto" style="color:red"> </span>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection