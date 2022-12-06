@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="p-3">Hi Admin!</h2>
        </div>
        <div class="row mb-5">
            <ul class="nav nav-pills m-3">
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-panel/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin-panel/promotions">Promotions</a>
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
                            <th scope="col">Discount</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotion as $promotion)
                        <tr>
                            <td>{{ $promotion['discount'] }}%</td>
                            <td>{{ substr($promotion['start_date'], 0, 10) }}</td>
                            <td>{{ substr($promotion['final_date'], 0, 10) }}</td>
                            <td>
                                <!--código de form action para delete promotion-->
                                <form action="{{ route('editPromotion', array('id'=>$promotion['id'])) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-pencil"></i>
                                        edit
                                    </button>
                                </form>
                            </td>
                            <td>
                                <!--código de form action para delete promotion-->
                                <form action="{{ route('deletePromotion', array('id'=>$promotion['id'])) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-regular fa-xmark"></i>
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