@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <!--
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/promotions">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin-panel/reports">Reports</a>
                </li>
            </ul
            >-->
            <div class="col-6"></div>
            <div class="col-6 mb-3">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="accordion" id="accordion">
                @foreach($reports as $report)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$report->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$report->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$report->id}}">
                                <!-- imagem -->
                                <!--<div class="col-1 pe-3">
                                    <img src="{{ $report->review->product->images[0]->file }}" alt="product image" 
                                        class="img-fluid">
                                </div>-->
                                <div class="col">
                                    @if ($report->resolved == false)
                                        <strong>Report ID: </strong>{{ $report->id }}
                                        <span class="badge bg-warning ms-3">Open</span>
                                    @elseif ( $report->resolved == true)
                                        <strong>Report ID: </strong>{{ $report->id }}
                                        <span class="badge bg-success ms-3">Closed</span>
                                    @endif
                                    <br>
                                    <br>
                                    User ID: {{ $report->user_id }}
                                    <br>
                                    Review ID: {{ $report->review_id }}
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$report->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$report->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Description:</strong> {{ $report->description }}
                                        <br>
                                        @if (is_null($report['created_at']))
                                        <strong>Report Date:</strong> Not Available
                                        @else
                                            <strong>Report Date:</strong> {{ substr($report['created_at'], 0, 10) }}
                                        @endif
                                    </div>
                                    <div class="col-3"></div>
                                    <div class="col-1">
                                    @if ($report->resolved == false)
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa-regular fa-envelope"></i>
                                            &nbsp;
                                            Close
                                        </button>
                                    @elseif ( $report->resolved == true)
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa-regular fa-envelope-open"></i>
                                            &nbsp;
                                            Open
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection