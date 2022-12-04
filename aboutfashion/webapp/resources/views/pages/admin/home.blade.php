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
                    <a class="nav-link" data-bs-toggle="tab" href="#products" aria-selected="true" role="tab">
                        Products
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#promotions" aria-selected="true" role="tab">
                        Promotions
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
                                                <button type="submit" class="btn btn-primary btn-sm">block</button>
                                            </form>
                                            @else
                                            <form action="{{ route('blockUser', array('id'=>$user['id'])) }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary btn-sm">unblock</button>
                                            </form>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('deleteUserAdmin', array('id'=>$user['id'])) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">delete</button>
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
                    <div id="producstList">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TENTATIVA DE PAGINAÇÃO; PRECISA DE LINKS PARA OUTRAS PÁGINAS EX: /ADMIN-PANEL/USERS/3
                                @php
                                    $i = 0;
                                @endphp
                                <nav aria-label="productsPagination">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item">
                                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Próximo</a>
                                        </li>
                                    </ul>
                                </nav> -->
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                        <td>
                                            <!--código de form action para delete product-->
                                            <!--<form action="{{ route('deleteProductAdmin', array('id'=>$product['id'])) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                            </form>-->
                                            <button type="submit" class="btn btn-danger btn-sm">delete</button>
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
                    <div id="promotionsList">

                    </div>
                </div>
                <div class="tab-pane fade show" id="orders" role="tabpanel">
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