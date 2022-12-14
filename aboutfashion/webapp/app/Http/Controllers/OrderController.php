<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Address;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
  public function checkout(Request $request){
    $validator = Validator::make($request->all(), [
      'id_card' => 'required|integer',
      'id_address' => 'required|integer'
    ]);
   
    if($validator->fails()){
      redirect()->back()->with('status', 'Bad request!'); //TODO ver isto
    }

    $user = Auth::user();
    $order = $user->orders()->where('status','Shopping Cart')->first();
    if(is_null($order)){
      echo 6;
      //return redirect()->back()->with('status', 'Shopping Cart Empty!');
    }

    $details = $order->details;
    if(count($details) == 0){
      echo 5;
      //return redirect()->back()->with('status', 'Shopping Cart Empty!');
    }

    $card = Card::find($request['id_card']);
    if($card){
      echo 4;
      //return redirect()->back()->with('status', 'Card not found!');
    }

    $address = Address::find($request['id_address']);
    if($address){
      echo 3;
      //return redirect()->back()->with('status', 'Address not found!');
    }

    $this->authorize('checkout', $card);
    $this->authorize('checkout', $address);
    

    $errors = array();
    foreach($details as $detail){
      $filters = array(['id_product', $detail['id_product']], ['id_color', $detail['id_color']], ['id_size', $detail['id_size']]);
      $stock = Stock::where($filters)->first();
      if($stock['stock'] < $detail['quantity']){
        array_push($errors, array('id_detail' => $detail, 'stock' => $stock['stock']));
      }
    }
    if(count($errors)!=0){
      echo 2;
      //return redirect()->back()->with('error', $errors);
    }

    try{
      DB::select('SELECT checkout(?)', array($order->id));
    }catch(Exception $e){
      echo 1;
      //return redirect()->back()->with('status', 'Something went wrong! Please try again!');
    }
        
    
  }
}