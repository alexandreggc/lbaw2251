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
    <div class="row" >
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
                    <fieldset class="form-group">
                        <legend class="mt-4">Sizes:</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sizes" id="sizes1" value="option1">
                            <label class="form-check-label" for="sizes1">XS</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sizes" id="sizes2" value="option2">
                            <label class="form-check-label" for="sizes2">S</label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="sizes" id="sizes3" value="option3" disabled="">
                            <label class="form-check-label" for="sizes3">M - Without Stock</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sizes" id="sizes4" value="option4">
                            <label class="form-check-label" for="sizes4">L</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-3">
                    <fieldset class="form-group">
                        <legend class="mt-4">Colors:</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="colors" id="colors1" value="option1">
                            <label class="form-check-label" for="colors1">Black</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="colors" id="colors2" value="option2">
                            <label class="form-check-label" for="colors2">Gray</label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="colors" id="colors3" value="option3">
                            <label class="form-check-label" for="colors3">Beige</label>
                        </div>
                    </fieldset>
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
</body>    

@endsection