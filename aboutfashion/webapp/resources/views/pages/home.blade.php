@extends('layouts.app')
@section('content')
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
        <div id="home_carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="/" data-slide-to="0" class="active"></li>
                <li data-target="/" data-slide-to="1"></li>
                <li data-target="/" data-slide-to="2"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://fotos.vivadecora.com.br/decoracao-loja-parede-com-painel-de-madeira-e-nichos-de-vidro-studiocostaazevedo-203580-square_cover_xlarge.jpg" alt="Hall">
                </div>
                <div class="carousel-item">
                    <img src="https://i.pinimg.com/736x/1c/a0/a2/1ca0a29402063f3bce2ba049e606facb.jpg" alt="Woman Section">
                </div>
                <div class="carousel-item">
                    <img src="https://i.pinimg.com/originals/d6/b4/75/d6b4759b0829e9e140a3b8d78155f2c0.jpg" alt="Man Section">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="/" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="/" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</div>
@endsection
