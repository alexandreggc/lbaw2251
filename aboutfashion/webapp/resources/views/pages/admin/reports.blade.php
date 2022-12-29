@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
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
            </ul>
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
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$report->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$report->id}}">
                                <div class="col-1 pe-3">
                                    <img src="{{ $report->review->product->images[0]->file }}" alt="product image" 
                                        class="img-fluid">
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <strong>Report ID: </strong>{{ $report->id }}
                                            <br>
                                            <br>
                                            <strong>User ID: </strong>{{ $report->user_id }}
                                            <br>
                                            <br>
                                            <strong>Review ID: </strong>{{ $report->review_id }}
                                        </div>
                                        <div class="col">
                                        @if ($report->resolved == false)
                                            <span class="badge bg-warning ms-3">Open</span>
                                        @elseif ( $report->resolved == true)
                                            <span class="badge bg-success ms-3">Closed</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{$review->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$review->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col">
                                        <strong>Description:</strong> {{ $report->description }}
                                        <br>
                                        <strong>Report Date:</strong> {{ substr($report['created_at'], 0, 10) }}
                                        <br>
                                        <strong>Description:</strong> {{ $review->description }}
                                        <br>
                                        <strong>Date:</strong> {{ substr($review['date'], 0, 10) }}
                                    </div>
                                    <div class="col-1">
                                    @if ($report->resolved == false)
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-regular fa-envelope"></i>
                                            Close
                                        </button>
                                    @elseif ( $report->resolved == true)
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-regular fa-envelope-open"></i>
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
            <!--
            <div id="reportsList">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Report ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Review ID</th>
                            <th scope="col">Description</th>
                            <th scope="col">Report Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            @if ($report->resolved == false)  
                                <tr>
                                    <th scope="row">{{ $report->id }}</th>
                                    <td>{{ $report->user_id }}</td>
                                    <td>{{ $report->review_id }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->created_at }}</td>
                                    <td><span class="badge bg-warning">Open</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa-regular fa-envelope"></i>
                                            Close
                                        </button>
                                    </td>
                                </tr>
                            @elseif ( $report->resolved == true)
                                <tr>
                                    <th scope="row">{{ $report->id }}</th>
                                    <td>{{ $report->user_id }}</td>
                                    <td>{{ $report->review_id }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ substr($report['created_at'], 0, 10) }}</td>
                                    <td><span class="badge bg-success">Closed</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-regular fa-envelope-open"></i>
                                            Open
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            -->
        </div>
    </div>
@endsection