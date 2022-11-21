@extends('layouts.app')

@section('content')

<head>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000">Home</a></li>
        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/api/products">Woman</a></li>
        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/api/products">Clothing</a></li>
        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/api/products">Jackets</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</head>
<body>
    <div class="row">
        <div class="col-md-5"> <img src=img alt="product image"></img></div>
        <!-- Ver como colocar carrosel de imagens com setinhas --> 
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-11"><h1>{{ $product->name }}</h1></div>
                <div class="col-md-1">
                    <i class="fa fa-heart-o" style="font-size:24px" href="http://127.00.1:8000/wishlist/{user_id}"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"><h5>Description:</h5></div>
                <div class="col-md-10"><p>{{ $product->description }}</p></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-outline-primary">Size</button>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" 
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            >
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item">XS</a>
                                    <a class="dropdown-item">S</a>
                                    <a class="dropdown-item">M</a>
                                    <a class="dropdown-item">L</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-outline-primary">Color</button>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop2" type="button" class="btn btn-outline-primary dropdown-toggle" 
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                            >
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" style="">
                                <a class="dropdown-item">Black</a>
                                <a class="dropdown-item">Gray</a>
                                <a class="dropdown-item">Beige</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <br>
                    <div class="row-md"><h4>Price: {{ $product->price }}€</h4></div>
                    <br>
                    <div class="row-md">
                        <button type="button" class="btn btn-lg btn-primary">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4>Reviews:</h4>
    </div>
    <div class="row"> <!-- zona de reviews -->
        <div class="col"> <!-- primeira coluna de reviews -->
            <div class="row"> <!-- elemento da primeira coluna -->

            </div>
            <div class="row">

            </div>
            <div class="row">

            </div>
        </div>
        <div class="col"> <!-- segunda coluna de reviews -->
            <div class="row"> <!-- elemento da segunda coluna -->

            </div>
            <div class="row">

            </div>
            <div class="row">

            </div>
        </div>
    </div>
</body>    

@endsection