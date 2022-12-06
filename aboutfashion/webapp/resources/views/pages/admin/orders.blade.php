@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <ul id="profile-tab" class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#users" aria-selected="false" role="tab"
                        tabindex="-1">
                        Users
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="/admin-panel/products" aria-selected="true" role="tab">
                        Products
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="/admin-panel/promotions" aria-selected="true" role="tab">
                        Promotions
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="/admin-panel/orders" aria-selected="true" role="tab">
                        Orders
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="/admin-panel/reviews" aria-selected="true" role="tab">
                        Reviews
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="/admin-panel/reports" aria-selected="true" role="tab">
                        Reports
                    </a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show" id="users" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Users</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
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
                <div class="tab-pane fade show" id="products" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Products</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary m-3 ms-0">
                        <i class="fa-regular fa-plus"></i>
                        Add new product
                    </button>
                    <div id="producstList">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                        <td>
                                            <!--código de form action para delete product-->
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa-regular fa-pencil"></i>
                                                edit
                                            </button>
                                        <td>
                                            <!--código de form action para delete product-->
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-regular fa-xmark"></i>
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show" id="promotions" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Promotions</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div id="promotionsist">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promotion)
                                    <tr>
                                        <td>{{ $promotion['discount'] }}%</td>
                                        <td>{{ substr($promotion['start_date'], 0, 10) }}</td>
                                        <td>{{ substr($promotion['final_date'], 0, 10) }}</td>
                                        <td>
                                            <!--código de form action para delete promotion-->
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa-regular fa-pencil"></i>
                                                edit
                                            </button>
                                        <td>
                                            <!--código de form action para delete promotion-->
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-regular fa-xmark"></i>
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="orders" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Orders</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div id="ordersList">

                    </div>
                </div>
                <div class="tab-pane fade show" id="reviews" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Reviews</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div id="reviewsList">

                    </div>
                </div>
                <div class="tab-pane fade show" id="reports" role="tabpanel">
                    <div class=row>
                        <div class=col>
                            <h2>Reports</h2>
                        </div>
                        <div class=col>
                            <form class="d-flex">
                                <input class="form-control me-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div id="reportsList">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection