@extends('layouts.app')
@section('content')
    @csrf

    <script type="text/javascript" src={{ asset('js/shopping_cart.js') }} defer></script>
    <head>
        <ol class="breadcrumb p-3 pb-1">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shoppingCartView') }}">Shopping Cart</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </head>

    <body>
        <section class="pb-5">
            <div class="container">
                <h3 class="display-5 mt-3 mb-5 text-left">CHECKOUT</h3>
                <div class="row">
                        <div class=" card mt-1" style="border-color: #dee2e6;border-radius: 0;display: flex;flex-direction:row;" >
                            <div class="col col-md-6 mb-4 " style="flex: 1;" >
                            <h4 class="mt-4 mx-2 mb-3" style="">ADDRESSES</h4>
                            @if (is_null($addresses) || (!(count($addresses)>0))))
                            <div class="choice mx-3 mt-2 mb-4 text-center" >
                            <p>You don't have any address!</p>
                            <a href="{{ route('addressCreateForm') }}" class="mt-5"> Add address</a>
                            </div>
                            @else
                            <form class="text-center">
                            @foreach ($addresses as $address)
                            <div class="choice mx-3  mb-4 text-start" id="{{ $address['id'] }}">
                            <input class="mx-4" type="radio" id="radio-address-{{ $address['id'] }}" name="radio-group" value="option-1" checked>
                            <label class=" mx-2"for="radio-1">
                                <div>{{ $address['name'] }} , {{ $address['street'] }} {{ $address['number'] }}
                                </div>
                            </label>
                            </div>
                            @endforeach
                            <a href="{{ route('addressCreateForm') }}" class="mt-5"> Add address</a>
                            </form>
                            @endif
                            </div>
                            <div class="col-md-6 col mb-4 " style="flex: 1;">
                            <h4 class="mt-4 mb-3 mx-2" style="">CARDS</h4>
                            @if (is_null($cards) || (!(count($cards)>0))))
                            <div class="choice mx-3 mt-2 mb-4 text-center">
                            <p>You don't have any card!</p>
                            <a href="{{ route('cardCreateForm') }}" class="mt-5"> Add card</a>
                            </div>
                            @else
                            <form class="text-center">
                            @foreach ($cards as $card)
                            <div class="choice mx-3 mb-4 text-start"id="{{ $card['id'] }}" >
                            <input class="mx-4" type="radio" id="radio-card-{{ $card['id'] }}" name="radio-group" value="option-1" checked>
                            <label class=" mx-2"for="radio-1">
                                <div>{{ $card['name'] }} <small>({{ $card['nickname'] }})</small>
                                </div>
                            </label>
                            </div>
                            @endforeach
                            <a href="{{ route('cardCreateForm') }}" class="mt-5" style="text-align:center"> Add card</a>
                            </form>
                            @endif
                            </div>
                            
                        </div>
                </div>


                <div class="row mt-2 w-100">
                    <div class="col-lg-8 col-md-8 col-8">
                    <div class=" card mt-1 " style="border-color: #dee2e6;border-radius: 0;padding:2rem;">
                        <h4 class="mt-2 mx-5 mb-2" style="">SHOPPING CART</h4>
                        <table id="shoppingCart" class="table table-condensed mb-4 table-responsive ">
                            <thead>
                                <tr>
                                    <th style="width:56%">Product</th>
                                    <th style="width:12%">Price</th>
                                    <th style="width:12%">Discount</th>
                                    <th style="width:8%">Quantity</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_null($order))
                                @else
                                    @foreach ($order->details as $detail)
                                        <tr id="row-{{ $detail->id }}" class="row-product-table">
                                            <td class=" align-middle " data-th="Product">
                                                <div class="row">
                                                    <div class="col-md-3 text-left">
                                                        <img src="{{ asset($detail->product->images[0]->imageURL()) }}" alt=""
                                                            class="img-fluid d-none d-md-block rounded mt-3 shadow ">
                                                    </div>
                                                    <div class="col-md-9  align-middle text-left mt-sm-2">
                                                        <h4>{{ $detail->product['name'] }}</h4>
                                                        <p class="font-weight-light">Size: {{ $detail->size['name'] }} <br>
                                                            Color: {{ $detail->color['name'] }} </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" align-middle " data-th="Price">
                                                <div class=" mt-sm-2">
                                                    @php
                                                        $finalPrice = $detail->product->getPriceWithPromotion(date('Y-m-d H:i:s'));
                                                    @endphp
                                                    <p class="font-weight-light">{{ $finalPrice }}€
                                                        @if ($finalPrice == $detail->product['price'])
                                                    </p>
                                                @else
                                                    <small class="dis-price"
                                                        style="color: #888;text-decoration: line-through;">{{ $detail->product['price'] }}€</small>
                                                    </p>
                                                @endif
                                                <span id="original-price-{{ $detail->id }}"
                                                    style="display: none">{{ $detail->product['price'] }}</span>
                                                <span id="final-price-{{ $detail->id }}"
                                                    style="display: none">{{ $finalPrice }}</span>

                                            </div>
                                            </td>
                                            <td class=" align-middle text-center" data-th="Discount">
                                                @if ($finalPrice == $detail->product['price'])
                                                    -
                                                @else
                                                    {{ $detail->product->getPromotion(date('Y-m-d H:i:s'))->discount }}%
                                                @endif

                                            </td>
                                            <td class=" align-middle " data-th="Quantity ">
                                                <input readonly type="number" class="form-control form-control-sm text-center update-quantity"
                                                    value="{{ $detail->quantity }}" min="1" id={{ $detail->id }}>
                                                <span id="quantity-{{ $detail->id }}" style="display: none">{{ $detail->quantity }}</span>
                                            </td>
                                            <td class="actions align-middle " data-th="">
                                                <div class="text-right justify-content-center">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('searchProductView') }}" class="mt-5"><i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                        </div>
                    </div>
                    <div class=" col-lg-4 col-md-4 col-4 " style="padding:0;">
                        <div class=" card mt-1" style="border-color: #dee2e6;border-radius: 0;">
                            <h4 class="mt-5 mx-5" style="">CHECKOUT</h4>
                            <div class="col mx-5 mb-5 my-2">
                                <div class="d-flex justify-content-between my-3 information">
                                    <span>Subtotal</span><span id="subtotal"></span>
                                </div>
                                <div class="d-flex justify-content-between my-3 information">
                                    <span>Discount</span><span id="discount"></span>
                                </div>
                                <div class="d-flex justify-content-between my-3 information">
                                    <span>Total</span><span id="total" style="padding: 0;"></span>
                                </div>
                                <button class="btn btn-primary btn-block d-flex mx-auto mt-5"
                                    style="background-color:rgba(0,0,0,.9);" type="button"><span>Buy Now</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
@endsection