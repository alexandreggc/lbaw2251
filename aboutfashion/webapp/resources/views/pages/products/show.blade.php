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
        <div class="col-md-5">
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
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-11"><h1>{{ $product->name }}</h1></div>
                <div class="col-md-1">
                    <!-- Ver como colocar coração com link; com href no <i> não funciona --> 
                    <i class="fa fa-heart-o" style="font-size:24px" href="http://127.00.1:8000/wishlist/{user_id}"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"><h5>Description:</h5></div>
                <div class="col-md-10"><p>{{ $product->description }}</p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><h6>Classification:</h6></div>
                <div class="col-md-2"><p>5</p></div>
            <div class="row">
                <div class="col-md-4">
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
                <div class="col-md-4">
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
                <div class="col-md-4">
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
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 1</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 1</p> <!-- título da review -->
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row"> <!-- elemento da primeira coluna -->
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 3</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 3</p> <!-- título da review -->
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row"> <!-- elemento da primeira coluna -->
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 5</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 5</p> <!-- título da review -->
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col"> <!-- segunda coluna de reviews -->
            <div class="row"> <!-- elemento da segunda coluna -->
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 2</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 2</p> <!-- título da review -->
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row"> <!-- elemento da segunda coluna -->
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 4</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 4</p> <!-- título da review -->
                    </div>
                    <div class="row">
                        <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro.</p> <!-- texto da review -->
                    </div>
                </div>
            </div>
            <div class="row"> <!-- elemento da segunda coluna -->
                <div class="col-md-2">
                        <img src="/resources/defaultProfilePicture.png" alt="user image"></img> <!-- imagem de perfil de quem fez a review -->
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <h5>Nome do utilizador 6</h5> <!-- nome do utilizador que fez a review -->
                        </div>
                        <div class="col">
                            <h6>5</h6> <!-- classificação da review -->
                        </div>
                    </div>
                    <div class="row">
                            <p>Review 6</p> <!-- título da review -->
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