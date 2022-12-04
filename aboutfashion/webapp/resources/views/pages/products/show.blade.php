@extends('layouts.app')
@section('content')
    <head>
        <ol class="breadcrumb p-3 pb-1">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('searchProductView') }}">Search</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </head>
    <body style="justify-content-center">
        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="card mb-5">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4">
                                    <img id="main-image" src="{{ $product->images[0]->file }}" width="400" />
                                </div>
                                <div class="thumbnail text-center">
                                    @foreach ($product->images as $image)
                                        <img src="{{ $image->file }}" onclick="change_image(this)" width="70" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4 mt-3">

                                <div class="mt-4 mb-3">
                                    <h3 class="text-uppercase ">{{ $product->name }}</h3>
                                    <div class="price d-flex flex-row align-items-center" id="price">

                                    </div>
                                    <span id="disc"></span>
                                </div>
                                <p class="about">{{ $product->description }}</p>
                                <ul class="list-unstyled d-flex  text-warning mb-0">
                                    @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->avg_classification)
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                </ul>
                                <div class="dropdown mt-3" id="div_color">
                                    <select class="form-select " id="color" name="id_color" style="width:150px">
                                        <option selected>Select color</option>
                                        @foreach ($product->colors()->distinct()->get() as $color)
                                            <option value="{{ $color['id'] }}">
                                                {{ $color['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="div_size">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class=" d-flex justify-content-center align-items-center text-center mx-auto mt-5 mb-5" style="width: 200px;">
            <h3 class="mx-auto" style="">Reviews</h3>
        </div>
        @php
        $n = ceil(count($product->reviews)/3);
        $j=0;
        @endphp
        <div id="carouselExampleControls" class="carousel slide carousel-dark text-center mx-3 mb-5"
            data-bs-ride="carousel">
            <div class="carousel-inner">
                @for ($i = 0; $i < $n; $i++)
                    @if ($i== 0)
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-4 mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp
                                @if($j==count($product->reviews))  
                                    </div>
                                    </div>
                                    </div>
                                    @break
                                @endif
                                <div class="col-lg-4 mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp
                                @if($j==count($product->reviews))  
                                    </div>
                                    </div>
                                    </div>
                                    @break
                                @endif
                                <div class="col-lg-4 mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp

                            </div>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp
                                @if($j==count($product->reviews))  
                                    </div>
                                    </div>
                                    </div>
                                    @break
                                @endif
                                <div class="col-lg-4  mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp
                                @if($j==count($product->reviews))  
                                    </div>
                                    </div>
                                    </div>
                                    @break
                                @endif
                                <div class="col-lg-4  mx-auto">
                                    <img class="rounded-circle shadow-1-strong mb-4"
                                        src="https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png"
                                        alt="avatar" style="width: 150px;" />
                                    <h5 class="mb-3">{{$product->reviews[$j]['id_user']}}</h5>
                                    <p>{{str_replace("-","/",strrev(substr($product->reviews[$j]['date'], 0 ,10)))}}</p>
                                    <p class="text-muted">
                                        <i class="fas fa-quote-left pe-2"></i>
                                        {{$product->reviews[$j]['description']}}
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                        @for ($t = 1; $t < 6; $t++)
                                            @if($t>$product->reviews[$j]['evaluation'])
                                            <li><i class="far fa-star fa-sm"></i></li>
                                            @else
                                            <li><i class="fas fa-star fa-sm"></i></li>
                                            @endif
                                        
                                        @endfor
                                    </ul>
                                </div>
                                @php
                                $j= $j+1;
                                @endphp
                            </div>
                        </div>
                    </div>
                    @endif
                @endfor
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </body>
    <script>
        addPrice()
        attachEvents()

        function attachEvents() {
            color = document.getElementById("color")
            color.addEventListener("change", addSize)
        }
        async function addPrice() {
            url = '/api/products?'
            url += 'id_product='
            url += "{{ $product->id }}"
            const response = await fetch(url)
            const product = await response.json()
            let price = document.getElementById("price")
            let newBodyp = drawPrice(product)
            price.innerHTML = newBodyp

            let disc = document.getElementById("disc")
            let newBodyd = drawDisc(product)
            disc.innerHTML = newBodyd


        }

        function drawPrice(product) {
            let out = "";
            for (const val of product) {
                if (val.promotion.discount == undefined) {
                    out += `
                    <span class="act-price">Price: ${val.price}€</span>
                    <div class="ml-2 mx-2"> <small class="dis-price"></small></div>`;

                } else {
                    out +=
                        `
                    <span class="act-price">Price: ${promoPrice(val.price,val.promotion.discount)}€</span>
                    <div class="ml-2 mx-2"> <small class="dis-price" style="color: #888;text-decoration: line-through;">${val.price}€</small></div>`;
                }

            }
            return out;
        }

        function drawDisc(product) {
            let out = "";
            for (const val of product) {
                if (!(val.promotion.discount == undefined)) {
                    out += `${val.promotion.discount}% OFF`;
                }
            }
            return out;
        }

        function promoPrice(value, promo) {
            return Math.round(value - (value * (promo / 100)));
        }

        async function addSize() {
            color = document.getElementById("color").value
            if (!(color == "Select color")) {
                url = '/api/products/stock?'
                url += 'id_product='
                url += "{{ $product->id }}"
                url += '&id_color='
                url += color
                const response = await fetch(url)
                const product = await response.json()
                size = document.getElementById('div_size')
                let out = ""
                out += `<div class="sizes mt-5">
                        <h6 class="text-uppercase">Size</h6> `
                let sizes = []
                let p = true
                for (const val of product) {
                    for (const i of sizes) {
                        if (i[0] === val.size.id){
                            p = false
                        }
                    }
                    if (p == true){
                        sizes.push([val.size.id,val.size.name])
                    }
                    p = true
                }
                
                sizes = sizes.sort()
                for (const number of sizes) {
                    out += `
                        <label class="radio"> <input type="radio" name="size" value="${number[0]}" checked> <span style="">${number[1]}</span> </label> 
                    `

                }
                out += `</div>
                    <div class="cart mt-4 align-items-center"> 
                        <button class="btn btn-primary mr-2 px-4" onclick="addProductCart()">Add to cart</button> 
                    </div>`
                size.innerHTML = out;
            } else {
                size = document.getElementById('div_size')
                let out = ""
                size.innerHTML = out;

            }
        }

        
    </script>
@endsection
