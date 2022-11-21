@extends('layouts.app')

@section('content')
    <form action="localhost:8000/api/cart/add" method="post">
        <label for="id_product">ID PRODUCT</label>
        <input type="text" name="id_product">
        <label for="id_size">ID SIZE</label>
        <input type="text" name="id_product">
        <label for="id_color">ID COLOR</label>
        <input type="text" name="id_color">
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity">
        <input type="submit" value="Subscribe!">
    </form>
@endsection
