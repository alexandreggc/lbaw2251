@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="p-3">Hi Admin!</h2>
    </div>
    <div class="row mb-5">
        <ul id="profile-tab" class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#users" aria-selected="false" role="tab" tabindex="-1">
                    Users
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#orders" aria-selected="true" role="tab">
                    Orders
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#reviews" aria-selected="true" role="tab">
                    Reviews
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#reports" aria-selected="true" role="tab">
                    Reports
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade show active" id="users" role="tabpanel">
                <h2>Users</h2>
                <div id="usersList">
                    <div class="accordion" id="accordion">
                        @foreach($users as $user)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$user->id}}">
                                @if ($user->blocked == 1)
                                <!-- Blocked -->
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{$user->id}}" aria-expanded="true" 
                                        aria-controls="collapse{{$user->id}}">
                                    <div class="col">
                                        {{$user['first_name'] . ' ' . $user['last_name']}}
                                        <span class="badge bg-danger ms-3">Blocked</span>
                                    </div>
                                    <div class="col-1">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#unblockModal">
                                            <i class="fa-regular fa-lock-open"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fa-regular fa-trash ps-5"></i>
                                        </a>
                                    </div>
                                </button>
                                @else
                                <!-- Unblocked -->
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{$user->id}}" aria-expanded="true" 
                                        aria-controls="collapse{{$user->id}}">
                                    <div class="col">
                                        {{$user['first_name'] . ' ' . $user['last_name']}}
                                    </div>
                                    <div class="col-1">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#blockModal">
                                            <i class="fa-regular fa-lock"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fa-regular fa-trash ps-5"></i>
                                        </a>
                                    </div>
                                </button>
                                @endif
                            </h2>
                            <div id="collapse{{$user->id}}" class="accordion-collapse collapse" 
                                aria-labelledby="heading{{$user->id}}" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <strong>E-mail:</strong> {{$user['email']}}
                                    <br>
                                    <strong>Birth date:</strong> {{$user['birth_date']}}
                                    <br>
                                    <strong>Gender:</strong> {{$user['gender']}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="orders" role="tabpanel">
                <h2>Products</h2>
            </div>
            <div class="tab-pane fade show" id="orders" role="tabpanel">
                <h2>Orders</h2>
            </div>
            <div class="tab-pane fade show" id="reviews" role="tabpanel">
                <h2>Reviews</h2>
            </div>
            <div class="tab-pane fade show" id="reports" role="tabpanel">
                <h2>Reports</h2>
            </div>
        </div>
    </div>
    <!-- Block Modal -->
    <div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="blockModalLabel">Block User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to block this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" href="">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Unblock Modal -->
    <div class="modal fade" id="unblockModal" tabindex="-1" aria-labelledby="unblockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="unblockModalLabel">Unblock User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to unblock this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" href="">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" href="">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
