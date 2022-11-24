


@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 ">

    <div class="row mb-5">
        <div class="col-sm-3 col-md-3 col-lg-3 align-content-center justify-content-center mb-5" >
            <div class="row mx-auto">
                <ul class="nav nav-pills flex-column mb-3" style="padding-right:0;">
                    <li class="nav-item text-center">
                        <a class="nav-link active" href="" style="background-color:#ecf0f1; color:#212529; font-size: 24px;">Filters</a>
                    </li>
                </ul>
            
                <div class="card h-100 shadow costum-card text-center mx-auto">
                    <form class="mt-4 mb-4 " method="GET" >
                        <fieldset>
                            <div class="card-group ">
                        
                                <legend class="text-start ms-4">Categories</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" id="category" name="id_category">
                                            <option selected>Select category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">
                                            {{ $category['name'] }}
                                            </option>
                                             @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="card-group mt-4  ">
                                <legend class="text-start ms-4" >Size</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" name="id_size" id="size">
                                            <option selected>Select size</option>
                                            @foreach($sizes as $size)
                                            <option value="{{ $size['id'] }}">
                                            {{ $size['name'] }}
                                            </option>
                                             @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="card-group mt-4  ">
                                <legend class="text-start ms-4" >Color</legend>
                                <fieldset class="form-group mx-3" style="width:100%;">
                                    <select class="form-select" id="color" name="id_color">
                                            <option selected>Select color</option>
                                            <option><i class="fa-solid fa-stop" style="background-color:blue;"></i> Blue</option>
                                            @foreach($colors as $color)
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
                                        <div id="pmd-slider-value-range"  class="pmd-range-slider" min="0" max="200"></div>	
                                    </div>
                                    <div class="row mt-4">
                                        <div class=" text-center ms-5 min col-xs-6 "style="width: 80px;">
                                            <p>Min :</p>
                                            <input type="text" id="value-min" name="min_price" style="width: 60px;" />
                                        </div>
                                        
                                        <div class="text-center me-5 ms-auto max col-xs-6" style="width: 80px;">
                                            <p>Max :</p>
                                            <input type="text" id="value-max" name="max_price" style="width: 60px;" />
                                        </div>
                                    </div>
                                    
                
                                </div>
                            </div>
                            <div class="card-group mt-4 ">
                                <legend class="text-start ms-4">Classification</legend>
                                <input type="range" class="form-range mx-auto" name="min_classification" style="width:60%;display:block;" min="0" max="5" step="1" id="myRange" value="0">
                                <p class="text-center me-5" ><span id="demo"></span> - 5</p>
                            </div>
                            <div class="card-group mt-4  ">
                                <button type="button" class="btn btn-primary mx-auto" id="filterButton" style="background-color:#000;">
                                Search
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-9 " >
            <div class="row mb-4">
               <form method="GET">
                    <select class="form-select ms-auto" name="order" style="background-color:#ecf0f1; width:15%; border: none; color:#212529; font-size: 18px;">
                        <option selected>Order</option>
                        <option>Jackets</option>
                        <option>T-shirts</option>
                    </select>
               </form>
            </div>
            <div class="container mx-auto" id="data-output">
                
            </div>
            
        </div>
    </div>
</div>
<script>
   $.ajax({
    url: 'http://127.0.0.1:8000/api/products',
    data: {},
    dataType: "json",
        cache: false,
        success: function (data) {
            let placeholder = document.getElementById("data-output");
            let out = "";
            $.each(data, function (i, val) {
                console.log(data);
                out += `
                    <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                        <div class="product-grid">
                            <div class="product-image shadow">
                                <a href="api/products?id_product=${val.id}" class="image">
                                    <img src="${val.images[0]}">
                                </a>
                                <span class="product-discount-label">${havePromo(val.promotion.discount)}</span>
                                <ul class="product-links">
                                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-content shadow">
                                <h3 class="title"><a href="#">${val.name}</a></h3>
                                <div class="price">${havePromo1(val.price,val.promotion.discount)} <span>${havePromo2(val.price,val.promotion.discount)}</span></div>
                            </div>
                        </div>
                    </div>
    
                `;
            });
            placeholder.innerHTML = out;
    }

});
    attachEvents()

    function attachEvents() {
        button = document.getElementById('filterButton')
        button.addEventListener('click', selectFilters)

    }

    async function selectFilters(element) {
        url='/api/products?'
        category = document.getElementById('category').value
        if(!(category=='Select category')){
            url+='id_category='
            url+=category
            url+='&'
        }
        size = document.getElementById('size').value
        if(!(size=='Select size')){
            url+='id_size='
            url+=size
            url+='&'
        }
        
        color = document.getElementById('color').value
        if(!(color=='Select color')){
            url+='id_color='
            url+=color
            url+='&'
        }
        valueMin = document.getElementById('value-min').value
        url+='min_price='
        url+=valueMin
        url+='&'
        
        valueMax = document.getElementById('value-max').value
        url+='max_price='
        url+=valueMax
        url+='&'

        min_classification = document.getElementById('myRange').value
        if(!(min_classification==0)){
            url+='min_classification='
            url+=min_classification
        }else{
            url = url.slice(0, -1); 
        }
        
        const response = await fetch(url)
        const products = await response.json()
        console.log(drawProducts)
        let oldBody = document.getElementById("data-output")
        let newBody = drawProducts(products)

        oldBody.innerHTML=newBody
    }

    function drawProducts(products) {
        let out = "";
        for (const val of products) {
            out += `
                    <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                        <div class="product-grid">
                            <div class="product-image shadow">
                                <a href="api/products?id_product=${val.id}" class="image">
                                    <img src="${val.images[0]}">
                                </a>
                                <span class="product-discount-label">${havePromo(val.promotion.discount)}</span>
                                <ul class="product-links">
                                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-content shadow">
                                <h3 class="title"><a href="#">${val.name}</a></h3>
                                <div class="price">${havePromo1(val.price,val.promotion.discount)} <span>${havePromo2(val.price,val.promotion.discount)}</span></div>
                            </div>
                        </div>
                    </div>
    
                `;
        }

        return out;
    }


    function havePromo2(value,promo) {
        let result;
        if (promo == undefined) {
            result = "";
        } else {
            result = '$' + value ;
        }
        return result;
    }
    function havePromo1(value,promo) {
        let result;
        if (promo == undefined) {
            result = '$'+ value;
        } else {
            result = '$' + Math.round(value - (value*(promo/100)));
        }
        return result;
    }
    function havePromo(promo) {
        let result;
        if (promo == undefined) {
            result = "";
        } else {
            result = '-' + promo + '%';
        }
        return result;
    }
    function newPrice(promo) {
        let result;
        if (promo == undefined) {
            result = "";
        } else {
            result = '-'+ promo +'%';
        }
        return result;
    }
</script>

@endsection