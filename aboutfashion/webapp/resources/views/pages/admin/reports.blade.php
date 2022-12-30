@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
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
                                
                                <div class="col">
                                    @if ($report->resolved == false)
                                        <strong>Report ID: {{ $report->id }}</strong>
                                        <span class="badge bg-warning ms-3">Open</span>
                                    @elseif ( $report->resolved == true)
                                        <strong>Report ID: {{ $report->id }}</strong>
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
                                    @if (Auth::guard('admin')->user()->role == 'Technician')
                                        <div class="col-3"></div>
                                        <div class="col-1">
                                        @if ($report->resolved == false)
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-envelope"></i>
                                                &nbsp;
                                                Close
                                            </button>
                                        @elseif ( $report->resolved == true)
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-envelope-open"></i>
                                                &nbsp;
                                                Open
                                            </button>
                                        @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection