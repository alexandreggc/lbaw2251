@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin-panel">Users</a>
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
            <div class="col-6"></div>
            <div class="col-6 mb-3">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
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
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa-regular fa-user-lock"></i>
                                            block
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('blockUser', array('id'=>$user['id'])) }}" method="post">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-regular fa-user-unlock"></i>
                                            <i class="fa-regular fa-unlock"></i>
                                            unblock
                                        </button>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('deleteUserAdmin', array('id'=>$user['id'])) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-regular fa-user-xmark"></i>
                                            delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection