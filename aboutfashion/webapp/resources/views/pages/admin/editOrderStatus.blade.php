@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3 pb-5">Orders</h2>
        </div>
        <div class="row">
            <div class="col-1">
                <a href="/admin-panel/products">
                    <i class="fa-solid fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="col">
                <h3>Edit Status of order nº{{ $order['id'] }} from user {{ $order->user->name }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <form method="POST" action="{{ route('updateOrderStatus', ['id' => $order->id]) }}">
                    @csrf
                    @method('patch')
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