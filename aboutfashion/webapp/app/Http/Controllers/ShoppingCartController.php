<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use \App\Models\Order;
use \App\Http\Controllers\StockController;
use \App\Http\Controllers\DetailController;
use Auth;

class ShoppingCartController extends Controller{

    public function show(Request $request){
        $user = User::find($request['id_user']);
        //VER COMO RECEBER O ARRAY DE DETAILS PARA SEREM DEMONSTRADOS NA VIEW
        $cart = [];
        $total = 0;
        if(Auth::check()){
            $orders = $user->orders;
            foreach($orders as $order){
                $details = $order->details;
                foreach($details as $detail){
                    $total += $detail->price;
                    $cart->add($detail);
                }
            }
        }
        return view('pages.user.shopping_cart', ['user' => $user, 'cart' => $cart, 'total' => $total]);
    }

    public function addProductCart(Request $request){
        $this->validate($request, [
            'id_product' => 'required|integer',
            'id_size' => 'required|integer',
            'id_color' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        
        $id_product = $request['id_product'];
        $id_size = $request['id_size'];
        $id_color = $request['id_color'];
        $quantity = $request['quantity'];

        $stockController = new StockController();
        $detailController = new DetailController();

        if($detailController->updateQuantityAux($quantity, $id_color, $id_color, $id_product)){
            return response('Ok! Product updated.',200)->header('Content-Type', 'text/plain');
        }

        if($stockController->hasStock($id_product, $id_size, $id_color)){
            abort(404, 'Product not found!');
        }

        $detail = $detailController->store($quantity, $id_size, $id_color, $id_product);
        $shoppingCart = $this->createShoppingCart();
        
        $shoppingCart->details()->attach($detail);
        
        return response('Ok! Product added.',200)->header('Content-Type', 'text/plain');
    }

    public function deleteProductCart(Request $request){
        $this->validate($request, [
           'id_detail' => 'required|integer',
        ]);

        $detailController = new DetailController;
        
        $query = Order::where('status', 'Shopping Cart')->where('id_user', Auth::user()->id())->get();
        if(count($query) == 0){
            abort(404, 'Product not found!');
        }
        
        $detailController->delete($request['id_detail'], $query[0]['id']);
    }

    public function createShoppingCart(){
        $query = Order::where('id_user', Auth::user()->id)->where('status', 'Shopping Cart')->get();
        if(count($query) == 0){
            $order = new Order();
            $order->status = 'Shopping Cart';
            $order->date = date('Y-m-d H:i:s');
            $order->id_user = Auth::user()->id;
            $order->save();
            return $order;
        }
        return Order::find($query[0]['id']);
    }
}