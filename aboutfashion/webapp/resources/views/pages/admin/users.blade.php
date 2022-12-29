@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-3">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin-panel/users">Users</a>
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
                    <a class="nav-link" href="/admin-panel/reports">Reports</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 pb-3">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="accordion" id="accordion">
                @foreach($users as $user)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$user->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$user->id}}" aria-expanded="true" 
                                    aria-controls="collapse{{$user->id}}">
                                <div class="col-1 pe-3">
                                    <img src="{{ $user->photo['file'] }}" alt="user photo" 
                                        class="img-fluid">
                                </div>
                                @if ($user->blocked == 1)
                                    <div class="col">
                                        {{$user['first_name'] . ' ' . $user['last_name']}}
                                        <span class="badge bg-danger ms-3">Blocked</span>
                                    </div>
                                @else
                                    <div class="col">
                                        {{$user['first_name'] . ' ' . $user['last_name']}}
                                    </div>
                                @endif
                            </button>
                        </h2>
                        <div id="collapse{{$user->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$user->id}}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col">
                                        <strong>E-mail:</strong> {{$user['email']}}
                                        <br>
                                        <strong>Birth date:</strong> {{ isset($user['birth_date']) ? substr($user['birth_date'], 0, 10) : 'Not Defined'}}
                                        <br>
                                        <strong>Gender:</strong> {{ isset($user['gender']) ? $user['gender'] : 'Not Defined' }}
                                    </div>
                                    <div class="col-1">
                                        <div class="row">
                                            <a type="submit" class="btn btn-secondary btn-sm mb-3" 
                                                    href="{{ route('userPurchaseHistoryAdminPanel', ['id' => $user->id]) }}">
                                                <i class="fa-regular fa-bag-shopping"></i>
                                                &nbsp;
                                                history
                                            </a>
                                        </div>
                                        @if ($user['blocked'] == 0)
                                        <div class="row">
                                            <a type="submit" class="btn btn-warning btn-sm mb-3">
                                                <i class="fa-regular fa-user-lock"></i>
                                                &nbsp;
                                                block
                                            </a>
                                        </div>
                                        @else
                                        <div class="row">
                                            <a type="submit" class="btn btn-outline-primary btn-sm mb-3">
                                                <i class="fa-regular fa-user-unlock"></i>
                                                &nbsp;
                                                unblock
                                            </a>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <a type="submit" class="btn btn-danger btn-sm pe-1">
                                                <i class="fa-regular fa-user-xmark"></i>
                                                &nbsp;
                                                delete
                                            </a>
                                        </div>
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