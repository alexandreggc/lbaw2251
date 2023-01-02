@extends('layouts.admin')

@section('content')
    @csrf
    <script type="text/javascript" src={{ asset('js/product_admin.js') }} defer></script>
    <div class="container">
        <div class="row">
            <h2 class="p-3">Products</h2>
        </div>
        <div class="row mb-5">
            <div class="col-2">
                <a type="button" class="btn btn-outline-primary mb-4" href="{{ route('createProduct') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add Product
                </a>
            </div>
            <div class="col-4"></div>
            <div class="col-6">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="accordion" id="accordion">
                @foreach ($products as $product)
                    <div class="accordion-item" id="accordion-item-{{ $product->id }}">
                        <h2 class="accordion-header" id="heading{{ $product->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $product->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $product->id }}">
                                <div class="col-1 pe-3">
                                    <img src="{{ $product->images[0]->file }}" alt="product image" class="img-fluid">
                                </div>
                                <div class="col">
                                    <strong>Name: </strong>{{ $product->name }}
                                    <br>
                                    <br>
                                    <strong>Price: </strong>{{ $product->price }}
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{ $product->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $product->id }}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col">
                                        <strong>Description:</strong> {{ $product->description }}
                                        <br>
                                        <strong>Classification:</strong>
                                        {{ is_null($product->avg_classification) ? 'No reviews yet' : number_format($product->avg_classification, 2, '.', '') }}
                                    </div>
                                    @if (Auth::guard('admin')->user()->role == 'Collaborator')
                                        <div class="col-1">
                                            <div class="row">
                                                <a type="submit" class="btn btn-primary btn-sm mb-3"
                                                    href="{{ route('editProduct', ['id' => $product->id]) }}">
                                                    <i class="fa-solid fa-pencil"></i>
                                                    &nbsp;
                                                    edit
                                                </a>
                                            </div>
                                            <div class="row">
                                                <button class="btn btn-danger btn-sm pe-1 fa-solid fa-xmark delete-product" 
                                                        id="{{ $product->id }}">
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="padding-top:1em;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
