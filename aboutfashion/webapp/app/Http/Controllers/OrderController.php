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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller{

  public function __construct(){
    $this->middleware('auth:web');
  }

  public function show($id){
    $order = Order::find($id);
    $this->authorize('show', $order);
    return view('pages.order', ['order' => $order]);
  }

  public function create(Request $request){
  }

  public function store(Request $request){
  }

  public function edit(Request $request){
      $this->authorize('updateOrder', Auth::guard('admin')->user());
      $order = Order::find($request->id);
      $products = Product::all();
      // REVER O QUE ENVIAR PARA A VIEW DE EDIÇÃO DAS ORDERS
      // ADDRESS, CARD, STOCK ??
      return view('pages.admin.editPromotion', ['order'=>$order, 'products' => $products]);
  }

  public function update(Request $request){
  }

  public function delete($id){
      if(!is_numeric($id)){
          return Response::json(array('status' => 'error', 'message'=>'Bad request!'),400);
      }

      $this->authorize('updateOrder', Auth::guard('admin')->user());
      $order = Order::find($id);
      if(is_null($order)){
          return Response::json(array('status' => 'error', 'message' => 'Order not found!'), 404);
      }

      if($order->delete()){
          return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
      }else{
          return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
      }
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
      return redirect()->back()->with('status', 'Shopping Cart Empty!');
    }

    $details = $order->details;
    if(count($details) == 0){
      return redirect()->back()->with('status', 'Shopping Cart Empty!');
    }

    if(!$card = Card::find($request['id_card'])){
      return redirect()->back()->with('status', 'Card not found!');
    }

    if(!$address = Address::find($request['id_address'])){
      return redirect()->back()->with('status', 'Address not found!');
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
      return redirect()->back()->with('error', $errors);
    }

    try{
      DB::select('SELECT checkout(?)', array($order->id));
    }catch(Exception $e){
      return redirect()->back()->with('status', 'Something went wrong! Please try again!');
    }
  }
}