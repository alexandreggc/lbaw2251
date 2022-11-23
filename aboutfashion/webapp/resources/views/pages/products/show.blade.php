@extends('layouts.app')
@section('content')
<head>
    <ol class="breadcrumb p-3 pb-1">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/products">Woman</a></li>
        <li class="breadcrumb-item"><a href="/products">Clothing</a></li>
        <li class="breadcrumb-item"><a href="/products">Jackets</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</head>
<body>
    <div class="row">
        <div class="col">
            <div id="carousel_product" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel_product" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel_product" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel_product" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row bg-body">
                            <div class="container-md ratio ratio-4x3">
                                <img class="d-block w-100 img-fluid img-thumbnail" src="https://figueiraradical.com/4128-large_default/sweat-carhartt-hooded.jpg" alt="Los Angeles">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row bg-body">
                            <div class="container-md ratio ratio-4x3">
                                <img class="d-block w-100 img-fluid img-thumbnail" src="https://photos6.spartoo.pt/photos/209/20939896/20939896_500_A.jpg" alt="Chicago">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row bg-body">
                            <div class="container-md ratio ratio-4x3">
                                <img class="d-block w-100 img-fluid img-thumbnail" src="https://www.lolitamoda.pt/uploads/photo/image/97253/gallery_M128722_1.JPG" alt="New York">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_product" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel_product" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-10"><h1 class="p-3 pt-0">{{ $product->name }}</h1></div>
                <div class="col-2">
                    <!-- Ver como colocar coração com link mas alterar a cor-->
                    <a class="pe-2 ps-5" href="#notimplemented">
                        <i class="fa fa-heart-o" style="font-size:24px"></i>
                    </a>
                </div>
            </div>
            <div class="row ps-3">
                <div class="col-2"><h5>Description:</h5></div>
                <div class="col-10"><p>{{ $product->description }}</p></div>
            </div>
            <div class="row p-3 pt-0">
                <div class="col-2"><h6>Classification:</h6></div>
                <div class="col-2"><p>5</p></div>
            <div class="row">
                <div class="col-4 p-5 pt-3 text-left">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Size
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">XS</a></li>
                            <li><a class="dropdown-item" href="#">S</a></li>
                            <li><a class="dropdown-item" href="#">M</a></li>
                            <li><a class="dropdown-item" href="#">XL</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-4 p-5 pt-3 text-left">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Color
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Black</a></li>
                            <li><a class="dropdown-item" href="#">Gray</a></li>
                            <li><a class="dropdown-item" href="#">Beige</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <br>
                    <div class="row"><h4>Price: {{ $product->price }}€</h4></div>
                    <br>
                    <div class="row">
                        <button type="button" class="btn btn-lg btn-primary" onclick="addProductCart()">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3 pt-5 pb-1">
        <h4>Reviews:</h4>
    </div>
    <div class="row"> <!-- zona de reviews -->
        <div class="col p-3"> <!-- primeira coluna de reviews -->
            <div class="row p-3"> <!-- elemento da primeira coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row p-3"> <!-- elemento da primeira coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row p-3"> <!-- elemento da primeira coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col p-3"> <!-- segunda coluna de reviews -->
            <div class="row p-3"> <!-- elemento da segunda coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row p-3"> <!-- elemento da segunda coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row p-3"> <!-- elemento da segunda coluna -->
                <div class="col-2">
                    <img class="rounded-2" src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png" width=100 height=100 alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-10">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col-1">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                        <div class="col-1">
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Review 1</p> <!-- título da review -->
                        </div>    
                        <div class="col-2">
                            <h6>10/10/2020</h6> <!-- data da review -->
                        </div>
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection