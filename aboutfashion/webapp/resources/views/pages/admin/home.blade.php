@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <ul id="profile-tab" class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#users" aria-selected="false" role="tab"
                        tabindex="-1">
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Birth Date</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Block Status</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            @if ($user['blocked'] == 1)
                                            <div class="col">
                                                {{ $user['first_name'] . ' ' . $user['last_name'] }}
                                                <span class="badge bg-danger ms-3">Blocked</span>
                                            </div>
                                            @else
                                            <div class="col">
                                                {{ $user['first_name'] . ' ' . $user['last_name'] }}
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ isset($user['birth_date']) ? substr($user['birth_date'], 0, 10) : 'Not Defined' }}</td>
                                        <td>{{ isset($user['gender']) ? $user['gender'] : 'Not Defined' }}</td>
                                        <td>
                                            @if ($user['blocked'] == 0)
                                            <form action="{{ route('blockUser', array('id'=>$user['id'])) }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <button type="submit" class="btn-sm">block</button>
                                            </form>
                                            @else
                                            <form action="{{ route('blockUser', array('id'=>$user['id'])) }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <button type="submit" class="btn-sm">unblock</button>
                                            </form>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('deleteUserAdmin', array('id'=>$user['id'])) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn-sm">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    </div>
@endsection