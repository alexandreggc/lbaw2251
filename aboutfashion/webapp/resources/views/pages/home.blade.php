@extends('layouts.app')
@section('content')
<<<<<<< HEAD
    <form action="localhost:8000/api/cart/add" method="post">
        <label for="id_product">ID PRODUCT</label>
        <input type="text" name="id_product">
        <label for="id_size">ID SIZE</label>
        <input type="text" name="id_product">
        <label for="id_color">ID COLOR</label>
        <input type="text" name="id_color">
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity">
        <input type="submit" value="Subscribe!">
    </form>
@endsection
=======
<div class="row">
    <div class="col">
        <h1>Promotion</h1>
        <h3>Up to 70% in all products</h3>
        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p>
        <div class="row">
            <div class="col">
                <a href="" class="btn btn-primary btn-lg">Man</a>
            </div>
            <div class="col">
                <a href="" class="btn btn-outline-primary btn-lg">Woman</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://figueiraradical.com/4128-large_default/sweat-carhartt-hooded.jpg" alt="Los Angeles">
                </div>
                <div class="carousel-item">
                    <img src="https://photos6.spartoo.pt/photos/209/20939896/20939896_500_A.jpg" alt="Chicago">
                </div>
                <div class="carousel-item">
                    <img src="https://www.lolitamoda.pt/uploads/photo/image/97253/gallery_M128722_1.JPG" alt="New York">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</div>
@endsection
>>>>>>> e88d3ca0776a2b72206ce2b1c48292f79da91716
