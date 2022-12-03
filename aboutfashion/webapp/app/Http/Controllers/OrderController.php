<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{

  public function __construct(){
    $this->middleware('auth:web');
  }

    public function show($id)
    {
      $order = Order::find($id);
      $this->authorize('show', $order);
      return view('pages.order', ['order' => $order]);
    }

    
}