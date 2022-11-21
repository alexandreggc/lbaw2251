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
    <h2>Personal Information</h2>
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
          <span>{{$user['birth_date']}}</span>
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
    
    <?php foreach ($user->addresses as $address){?>
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
    <?php } ?>
  </div>
  <div class="tab-pane fade" id="orders" role="tabpanel">
  <h2>My Orders</h2>
  
    <?php foreach ($user->orders as $order){?>
      {{$order->details}}
    <?php } ?>
    
  </div>
  <div class="tab-pane fade" id="wishlist" role="tabpanel">
    <p>This is the wishlist page.</p>
  </div>
  <div class="tab-pane fade" id="reviews" role="tabpanel">
    <p>This is the reviews page.</p>
  </div>
  <div class="tab-pane fade" id="cards" role="tabpanel">
    <p>This is the cards page.</p>
  </div>
</div>


@endsection
