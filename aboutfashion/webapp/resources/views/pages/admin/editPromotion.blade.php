@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3 pb-5">Promotions</h2>
        </div>
        <div class="row">
            <div class="col-1">
                <a href="/admin-panel/promotions">
                    <i class="fa-regular fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="col">
                <h3>Edit Informations of promotion {{ $promotion->id }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <form method="POST" action="{{ route('updatePromotion', ['id' => $promotion->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="productSelect" class="form-label mt-4"></label>
                        <select class="form-select" id="categorySelect" name="id_product" onchange="showProduct()"> <!-- ATENÇÃO AO ONCHANGE -->
                            <option>Select a product</option> <!-- VER COMO ADICIONAR MAIS QUE UM PRODUTO -->
                            @foreach ($products as $product)
                                <option value="{{$product['id']}}">{{$product['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discount" class="form-label mt-4">Discount</label>
                        <input type="number" class="form-control" id="promotion_discount" value="{{$promotion->discount}}" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="form-label mt-4">Start Date</label>
                        <input type="date" class="form-control" id="promotion_start_date" value="{{$promotion->start_date}}" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="final_date" class="form-label mt-4">Final Date</label>
                        <input type="date" class="form-control" id="promotion_final_date" value="{{$promotion->final_date}}" name="final_date">
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