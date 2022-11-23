@extends('layouts.app')
@section('content')
<head>
    <ol class="breadcrumb p-3 pb-1">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Shopping Cart</li>
    </ol>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col m-3 ms-0">
                <h1>Shopping Cart</h1>
            </div>
        </div>
        @if (count($cart) > 0)
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!--<th scope="col">Image</th>-->
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <!-- <td>{{$item->product->image}}</td> VER ESTA HIPOTESE -- Não funciona assim -->
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}€</td>
                            <td>{{$item->color}}</td>
                            <td>{{$item->size}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price * $quantity }}€</td>
                            <td><i class="fa-solid fa-trash" href="/remove/{{$item->id}}" styles="color: $danger"></i></td> <!-- a cor não está a associar -->
                        </tr>
                        @endforeach
                        <!--  
                        exemplo para ver como ficam os elementos
                        <tr>
                            <td>zip up bomber jacket</td>
                            <td>50€</td>
                            <td>Black</td>
                            <td>S</td>
                            <td>
                                <input type="number" class="form-control" aria-label="Example text with button addon" 
                                    aria-describedby="button-addon1" value={{$q}}>
                            </td>
                            <td>{{ 50 * 4 }}€</td>
                            <td><i class="fa-solid fa-trash" styles="color:red"></i></td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Total: {{$total}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <a href="/checkout">
                    <button type="button" class="btn btn-primary m-3 ms-0">Checkout</button>
                </a>
            </div>
            <div class="col-md-2">
                <a href="/products">
                    <button type="button" class="btn btn-outline-primary m-3 ms-0">Continue Shopping</button>
                </a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col">
                <p class="text-info">There are no products in your shopping cart</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <a href="/products">
                    <button type="button" class="btn btn-outline-primary m-3 ms-0">Discover our products</button>
                </a>
            </div>
        </div>
        @endif
    </div>
</body>
@endsection
