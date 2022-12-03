@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 ">

        <div class="row mb-5">
            <div class="col-sm-3 col-md-3 col-lg-3 align-content-center justify-content-center mb-5">
                <div class="row mx-auto">
                    <ul class="nav nav-pills flex-column mb-3" style="padding-right:0;">
                        <li class="nav-item text-center">
                            <a class="nav-link active" href=""
                                style="background-color:#ecf0f1; color:#212529; font-size: 24px;">Filters</a>
                        </li>
                    </ul>

                    <div class="card h-100 shadow costum-card text-center mx-auto">
                        <form class="mt-4 mb-4 " method="GET">
                            <fieldset>
                                <div class="card-group ">

                                    <legend class="text-start ms-4">Categories</legend>
                                    <fieldset class="form-group mx-3" style="width:100%;">
                                        <select class="form-select" id="category" name="id_category">
                                            <option selected>Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}">
                                                    {{ $category['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="card-group mt-4  ">
                                    <legend class="text-start ms-4">Size</legend>
                                    <fieldset class="form-group mx-3" style="width:100%;">
                                        <select class="form-select" name="id_size" id="size">
                                            <option selected>Select size</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size['id'] }}">
                                                    {{ $size['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="card-group mt-4  ">
                                    <legend class="text-start ms-4">Color</legend>
                                    <fieldset class="form-group mx-3" style="width:100%;">
                                        <select class="form-select" id="color" name="id_color">
                                            <option selected>Select color</option>
                                            <option><i class="fa-solid fa-stop" style="background-color:blue;"></i> Blue
                                            </option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color['id'] }}">
                                                    {{ $color['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="card-group mt-4 ">
                                    <legend class="text-start ms-4">Price</legend>
                                    <div class="container" id="c1">
                                        <div class="row1 mx-auto">
                                            <div id="pmd-slider-value-range" class="pmd-range-slider" min="0"
                                                max="200"></div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class=" text-center ms-5 min col-xs-6 "style="width: 80px;">
                                                <p>Min :</p>
                                                <input type="text" id="value-min" name="min_price"
                                                    style="width: 60px;" />
                                            </div>

                                            <div class="text-center me-5 ms-auto max col-xs-6" style="width: 80px;">
                                                <p>Max :</p>
                                                <input type="text" id="value-max" name="max_price"
                                                    style="width: 60px;" />
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="card-group mt-4 ">
                                    <legend class="text-start ms-4">Classification</legend>
                                    <input type="range" class="form-range mx-auto" name="min_classification"
                                        style="width:60%;display:block;" min="0" max="5" step="1"
                                        id="myRange" value="0">
                                    <p class="text-center me-5"><span id="demo"></span> - 5</p>
                                </div>
                                <div class="card-group mt-4  ">
                                    <button type="button" class="btn btn-primary mx-auto" id="filterButton"
                                        style="background-color:#000;">
                                        Search
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 ">
                <div class="row mb-4 ms-5 mt-1">
                    <input type="text" class="ms-1" id="fname" name="product_name" placeholder="Search..."
                        style="width:60%;display:inline;">
                    <button type="button" class="btn btn-primary justify-content-center align-content-center "
                        id="searchButton" style="background-color:#fff;width:7%;border:none;"><i
                            class="fa-solid fa-magnifying-glass mx-auto"
                            style="font-size:25px;width:6%;color:#000; "></i></button>

                    <form method="GET" class="ms-auto" style="display:inline;width:20%;">
                        <select class="form-select " name="order"
                            style="background-color:#ecf0f1;  display:inline; border: none; color:#212529; font-size: 18px;">
                            <option selected>Order</option>
                            <option>Jackets</option>
                            <option>T-shirts</option>
                        </select>
                    </form>
                </div>
                <div class="spinner-border text-primary" id="spinner" role="status">
                </div>
                <div class="container mx-auto" id="data-output">

                </div>

            </div>
        </div>
    </div>
@endsection
