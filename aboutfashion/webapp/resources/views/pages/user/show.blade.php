@extends('layouts.app')

@section('content')

<ul id="profile-tab" class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" data-bs-toggle="tab" href="#information" aria-selected="false" role="tab" tabindex="-1">Information</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-bs-toggle="tab" href="#addresses" aria-selected="true" role="tab">Addresses</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-bs-toggle="tab" href="#orders" aria-selected="true" role="tab">Orders, History and Details</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-bs-toggle="tab" href="#wishlist" aria-selected="true" role="tab">Wishlist</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-bs-toggle="tab" href="#reviews" aria-selected="true" role="tab">Reviews</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-bs-toggle="tab" href="#cards" aria-selected="true" role="tab">Cards</a>
  </li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade show active" id="information" role="tabpanel">
    <div id="top_title">
      <h2>Personal Information</h2>
      <a class="btn btn-primary" href="{{url('/users/1/edit')}}" role="button"> Edit profile </a>
    </div>
    <div id="personalInfo">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Social title
          <span>{{$user['first_name']." ".$user['last_name']}} </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          First name
          <span>{{$user['first_name']}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Second name
          <span>{{$user['last_name']}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Email
          <span>{{$user['email']}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Birth Date
          <span>{{substr($user['birth_date'],0,10)}}</span>
        </li>
      </ul>
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="card-title">Profile Picture</h5>
        </div>
        <img src={{$user->photo['file']}} id="profilePic" width="300px" height="300px"/>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="addresses" role="tabpanel">
    <h2>My Addresses</h2>
    @foreach ($user->addresses as $address)
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Name
          <span>{{isset($address['name']) ? $address['name'] : "Not Defined"}} </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Company
          <span>{{isset($address['company']) ? $address['company'] : "Not Defined"}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          NIF
          <span>{{isset($address['nif']) ? $address['nif'] : "Not Defined"}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Street
          <span>{{isset($address['street']) ? $address['street'] : "Not Defined"}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Number
          <span>{{isset($address['number']) ? $address['number'] : "Not Defined"}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Apartment
          <span>{{isset($address['apartment']) ? $address['apartment'] : "Not Defined"}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Note
          <span>{{isset($address['note']) ? $address['note'] : "Not Defined"}}</span>
        </li>
      </ul>
    @endforeach
  </div>
  <div class="tab-pane fade" id="orders" role="tabpanel">
    <h2>My Orders</h2>
    <div id="orders_info">
      @foreach ($user->orders as $order)
        <div class="card border-primary mb-3" style="max-width: 23rem;">
          <div class="card-header">Order #{{$order['id']}}</div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Date
                <span >{{substr($order['date'],0,10)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Status
                <span class="badge bg-primary">{{$order['status']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Address Name
                <span>{{$order['address']['name']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Card Number
                <span>{{$order['card']['number']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Products
                <span>
                @foreach ($order->details as $detail)
                  {{$detail->product['name']}} <br>
                @endforeach
                </span>
              </li>
            </ul>
            <a href="#" class="card-link">More Details</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="tab-pane fade" id="wishlist" role="tabpanel">
    <p>This is the wishlist page.</p>
  </div>
  <div class="tab-pane fade" id="reviews" role="tabpanel">
    <p>This is the reviews page.</p>
  </div>
  <div class="tab-pane fade" id="cards" role="tabpanel">
    <h2>My Cards</h2>
    <div id="card_info">
      @foreach ($user->cards as $card)
        <div class="card border-primary mb-3" style="max-width: 23rem;">
          <div class="card-header">Card #{{$card['number']}}</div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Nick name
                <span >{{$card['nickname']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Name
                <span>{{$card['name']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Month/Year
                <span>{{$card['month']}}/{{$card['year']}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Code
                <span>{{$card['code']}}</span>
              </li>
            </ul>
            <a href="#" class="card-link">Edit card</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>


@endsection
