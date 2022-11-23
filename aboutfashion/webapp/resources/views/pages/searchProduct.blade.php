


@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 ">
    <div class="row ms-4">
        <ol class="breadcrumb mt-5">
                    <li class="breadcrumb-item"><a class=" link-primary text-decoration-underline" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a  class=" link-primary text-decoration-underline" href="#">Library</a></li>
                    <li class="breadcrumb-item active">Data</li>
        </ol>
    </div>

    <div class="row mb-5">
        <div class="col-sm-3 col-md-3 col-lg-4 align-content-center justify-content-center mb-5" >
            <div class="row mx-auto">
                <ul class="nav nav-pills flex-column mb-3" style="padding-right:0;">
                    <li class="nav-item text-center">
                        <a class="nav-link active" href="" style="background-color:#ecf0f1; color:#212529; font-size: 24px;">Filters</a>
                    </li>
                </ul>
            
                <div class="card h-100 shadow costum-card text-center mx-auto">
                    <form class="mt-4 mb-4 " method="GET">
                        <fieldset>
                            <div class="card-group ">
                        
                                <legend class="text-start ms-4">Categories</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" name="category">
                                            <option selected>Select category</option>
                                            <option>Jackets</option>
                                            <option>T-shirts</option>
                                            <option>T-shirts</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="card-group mt-4  ">
                                <legend class="text-start ms-4" >Size</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" name="size">
                                            <option selected>Select size</option>
                                            <option>XS</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="card-group mt-4  ">
                                <legend class="text-start ms-4" >Color</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" name="color">
                                            <option selected>Select color</option>
                                            <option><i class="fa-solid fa-stop" style="background-color:blue;"></i> Blue</option>
                                            <option>Red</option>
                                            <option>Yelllow</option>
                                            <option>Black</option>
                                            <option>White</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="card-group mt-4 ">
                                <legend class="text-start ms-4">Price</legend>
                                <div class="container" id="c1">
                                    <div class="row">
                                        <div id="pmd-slider-value-range"  class="pmd-range-slider" min="0" max="200"></div>	
                                    </div>
                                    <div class="row">
                                        <div class="min d-flex justify-content-start">
                                            <p>Min :</p>
                                            <input type="text" id="value-min" />
                                        </div>
                                        
                                        <div class="max d-flex justify-content-end">
                                            <p>Max :</p>
                                            <input type="text" id="value-max" />
                                        </div>
                                    </div>
                                    
                
                                </div>
                            </div>
                            <div class="card-group mt-4 ">
                                <legend class="text-start ms-4">Classification</legend>
                                <input type="range" class="form-range mx-auto" style="width:60%;display:block;" min="0" max="5" step="1" id="myRange" value="0">
                                <p class="text-center me-5" ><span id="demo"></span> - 5</p>
                            </div>
                            <div class="card-group mt-4  ">
                                <button type="submit" class="btn btn-primary mx-auto" style="background-color:#000;">
                                Search
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-8 " >
            <div class="row mb-4">
               <form method="GET">
                    <select class="form-select ms-auto" name="order" style="background-color:#ecf0f1; width:15%; border: none; color:#212529; font-size: 18px;">
                        <option selected>Order</option>
                        <option>Jackets</option>
                        <option>T-shirts</option>
                    </select>
               </form>
            </div>
            <div class="container mx-auto">
                <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label">-23%</span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 <span>$68.88</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4  mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label"></span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Men's Jacket</a></h3>
                            <div class="price">$75.55<span></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4  mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label">-23%</span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 <span>$68.88</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4  mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label"></span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Men's Jacket</a></h3>
                            <div class="price">$75.55<span></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4  mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label">-23%</span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 <span>$68.88</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4  mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label"></span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Men's Jacket</a></h3>
                            <div class="price">$75.55<span></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label">-23%</span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 <span>$68.88</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label"></span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Men's Jacket</a></h3>
                            <div class="price">$75.55<span></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label">-23%</span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 <span>$68.88</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="https://picsum.photos/200">
                            </a>
                            <span class="product-discount-label"></span>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>                            </ul>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Men's Jacket</a></h3>
                            <div class="price">$75.55<span></span></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection