@extends('layouts.app')
@section('content')
<div class="row">
    <div id="carousel" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row bg-body">
                    <div class="col">
                        <h1 class="p-3">Promotion</h1>
                        <h3 class="ps-3">Up to 70% in all products</h3>
                        <p class="p-3">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p>
                        <div class="row text-center">
                            <div class="col">
                                <a href="/products">
                                    <button type="button" class="btn btn-primary btn-lg m-5">
                                        Shop Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col ratio ratio-4x3">
                        <img class="d-block w-100 img-fluid" src="https://fotos.vivadecora.com.br/decoracao-loja-parede-com-painel-de-madeira-e-nichos-de-vidro-studiocostaazevedo-203580-square_cover_xlarge.jpg" alt="Hall">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row bg-body">
                    <div class="col">
                        <h1 class="p-3">Promotion</h1>
                        <h3 class="ps-3">Up to 70% in all products</h3>
                        <p class="p-3">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p>
                        <div class="row text-center">
                            <div class="col">
                                <a href="/products">
                                    <button type="button" class="btn btn-primary btn-lg m-5">
                                        Shop Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col ratio ratio-4x3">
                        <img class="d-block w-100 img-fluid" src="https://media.istockphoto.com/id/916092484/photo/women-clothes-hanging-on-hangers-clothing-rails-fashion-design.jpg?s=612x612&w=0&k=20&c=fUpcbOITkQqitglZfgJkWO3py-jsbuhc8eZfb4sdrfE=" alt="Woman Section">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row bg-body">
                    <div class="col">
                        <h1 class="p-3">Promotion</h1>
                        <h3 class="ps-3">Up to 70% in all products</h3>
                        <p class="p-3">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p>
                        <div class="row text-center">
                            <div class="col">
                                <a href="/products">
                                    <button type="button" class="btn btn-primary btn-lg m-5">
                                        Shop Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col ratio ratio-4x3">
                        <img class="d-block w-100 img-fluid" src="https://i.pinimg.com/originals/d6/b4/75/d6b4759b0829e9e140a3b8d78155f2c0.jpg" alt="Man Section">
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@endsection
