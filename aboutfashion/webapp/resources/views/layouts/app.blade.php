<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cards.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/range-slider/css/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/textfield/css/textfield.css">
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/checkbox/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="http://propeller.in/components/range-slider/css/range-slider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/be2806c733.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src={{ asset('js/confirm_passwords.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/search_range.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <main>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" style="border: none;"
                            data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="ic fa fa-bars"></i>
                        </button>
                    </div>
                    <a class="navbar-brand mx-4 fw-bold" href="{{ route('home') }}">ABOUT FASHION</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-auto ">
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="/products"><i class="fa-solid fa-magnifying-glass"
                                        style="font-size:24px;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="#"><i class="fa-regular fa-bell"
                                        style="font-size:24px;"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user" style="font-size:24px;"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    @if (Auth::check())
                                        <li><span class="dropdown-item">Hello {{ Auth::user()->first_name }} !</span>
                                        </li>
                                        <li><a class="button dropdown-item"
                                                href="{{ route('userView', ['id' => Auth::user()->id]) }}"> See
                                                Profile </a></li>
                                        <li><a class="button dropdown-item" href="{{ route('logout') }}"> Logout </a>
                                        </li>
                                    @endif
                                    @if (!Auth::check())
                                        <li><a class="button dropdown-item" href="{{ url('/login') }}"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop1"> Sign In </a>
                                        </li>
                                        <li><a class="button dropdown-item" href="{{ url('/register') }}"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop2"> Register </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="#"><i class="fa-regular fa-heart"
                                        style="font-size:24px;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="#">
                                    <ion-icon name="cart-outline" style="font-size:28px;"></ion-icon>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Sign In</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('userLogin') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email" class="form-label mt-4">Email address</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required autofocus class="form-control" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                        <span class="error">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label mt-4">Password</label>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Password" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="error">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember Me
                                    </label>
                                </div>
                                <div class="modal-footer">
                                    <a class="button button-outline me-auto"
                                        href="{{ route('userRegister') }}">Forgot password</a> <!-- meter 'home' -->
                                    <button type="submit" class="btn btn-secondary">Login</button>
                                    <button type="button" class="btn btn-primary"><a
                                            class="button button-outline nav-link" href="{{ route('userRegister') }}"
                                            data-bs-dismiss="modal" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop2">Register</a></button>
                                    <!-- meter 'home' -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Register</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('userRegister') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="first_name" class="form-label mt-4">First Name</label>
                                    <input type="text" class="form-control" id="first_name"
                                        placeholder="First Name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="form-label mt-4">Last Name</label>
                                    <input type="text" class="form-control" id="last_name"
                                        placeholder="Last Name" name="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email1" class="form-label mt-4">Email address</label>
                                    <input id="email1" type="text" name="email" required autofocus
                                        class="form-control" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                        <span class="error">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label mt-4">Password</label>
                                    <input type="password" class="form-control" id="password1"
                                        placeholder="Password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label mt-4">Confirm Password</label>
                                    <input type="password" class="form-control" id="password2"
                                        placeholder="Password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <div class=" me-auto"></div>
                                    <label for="gender" class="form-label mt-4">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option selected>Select gender</option>
                                        <option value="F">FEMALE</option>
                                        <option value="M">MALE</option>
                                        <option value="O">OTHER</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class=" me-auto"></div>
                                    <label for="birthdate" class="form-label mt-4">Birthdate</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                                </div>
                                <div class="modal-footer">
                                    <span class="error-text me-auto" style="color:red"> </span>
                                    <button type="submit" class="btn btn-primary reg">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <section id="content">
            @yield('content')
        </section>

        <footer 
            class=" bg-light d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mt-auto">
            <p class="col-md-4 mb-0  mx-3"> &#169 About Fashion</p>
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"> <a href="/about"
                        class="nav-link px-2 mx-2 link-primary text-decoration-underline link-primary:hover">About
                        Us</a></li>
                <li class="nav-item"> <a href="/contacts"
                        class="nav-link px-2 mx-2 link-primary text-decoration-underline link-primary:hover">Contacts</a>
                </li>
                <li class="nav-item"> <a href=""
                        class="nav-link px-2 mx-2 link-primary text-decoration-underline link-primary:hover">Help</a>
                </li>
                <li class="nav-item"> <a href=""
                        class="nav-link px-2 mx-2 link-primary text-decoration-underline link-primary:hover">Follow
                        Us</a></li>
            </ul>
        </footer>

    </main>
    <!-- Jquery js -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Slider js  -->    
    <script src="http://propeller.in/components/range-slider/js/wNumb.js"></script>
    <script src="http://propeller.in/components/range-slider/js/nouislider.js"></script>
    

</body>

</html>
