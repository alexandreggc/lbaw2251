<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends Controller{

    public function showTest(Request $request){
        return Response::json($request->session()->get('cart'),200);
    }


    public function show(Request $request){
        $user = Auth::user(); 
        if(is_null($user)){
            return view('pages.user.shopping_cart', array('order'=>null));   
        }
        return view('pages.user.shopping_cart', array('order' => $user->orders->where('status', 'Shopping Cart')->first()));
    }

    private function checkCombination(int $id_product, int $id_color, int $id_size){
        return count(Stock::where('id_product', $id_product)->where('id_size', $id_size)->where('id_color', $id_color)->get()) != 0;
    }

    private function createShoppingCart(int $id_user){
        $shoppingCart = Order::where('id_user',$id_user)->where('status', 'Shopping Cart')->first();
        if(is_null($shoppingCart)){
            $shoppingCart = new Order();
            $shoppingCart->id_user = $id_user;
            $shoppingCart->date = date('Y-m-d H:i:s');
            $shoppingCart->save();
        }
        return $shoppingCart;
    }

    private function createDetail(int $id_order, int $id_product, int $id_color, int $id_size){
        $filters = array(['id_order',$id_order], ['id_product',$id_product], ['id_size',$id_size], ['id_color', $id_color]);
        $detail = Detail::where($filters)->first();
        if(is_null($detail)){
            $detail = new Detail();
            $detail->id_order = $id_order;
            $detail->id_product = $id_product;
            $detail->id_color = $id_color;
            $detail->id_size = $id_size;
            $detail->quantity = 0;
            $detail->save();
        }
        return $detail;
    }

    private function searchArray(int $id_product, int $id_color, int $id_size, array $cart){
        for($i = 0 ; $i < count($cart); $i++){
            if($cart[$i]['id_product'] == $id_product && $cart[$i]['id_color'] == $id_color && $cart[$i]['id_size'] == $id_size){
                return $i;
            }
        }
        return -1;
    }

    public function addProductAuth(int $id_product, int $id_color, int $id_size, int $quantity){
        $id_user = Auth::user()->id;
        $shoppingCart = $this->createShoppingCart($id_user);
        $detail = $this->createDetail($shoppingCart->id, $id_product,$id_color,$id_size);
        if(is_null($detail)){
            return false;
        }
        $detail->quantity += $quantity;
        if ($detail->save()) {
            return true;
        }
        return false;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
           'id_color' => 'required|integer',
           'id_size' => 'required|integer',
           'id_product' => 'required|integer'
        ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

        if(Auth::user()){
            if($this->addProductAuth($request['id_product'],$request['id_color'],$request['id_size'], 1)){
                return Response::json(array('status'=>'success','message' => 'The product has been added from your cart!'),200);
            }else{
                return Response::json(array('status'=>'error','message' => 'An error occurred and we were unable to add the product to your cart!'),500);
            }
        }
        else{
            if(!$this->checkCombination($request['id_product'], $request['id_color'], $request['id_size'])){
                return Response::json(array('status' => 'error', 'message => The product, color and size combination you want does not exist!'), 404);
            }
            if($cart = $request->session()->get('cart')){
                $i = $this->searchArray($request['id_product'], $request['id_color'], $request['id_size'], $cart);
                if($i === -1){
                    array_push($cart, array('id_product' => $request['id_product'], 'id_color' => $request['id_color'], 'id_size' => $request['id_size'], 'quantity' => 1));
                }else{
                    $cart[$i]['quantity']++;
                }
            }else{
                $cart = array();
                array_push($cart, array('id_product' => $request['id_product'], 'id_color' => $request['id_color'], 'id_size' => $request['id_size'], 'quantity' => 1));
            }            
            $request->session()->put('cart', $cart);
            
            return Response::json(array('status' => 'success', 'message' => 'The product has been added from your cart!'), 200);
        }

    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'id_detail' => 'integer',
            'id_color' => 'integer',
            'id_size' => 'integer',
            'id_product' => 'integer'
         ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

        if(isset($request['id_detail']) && Auth::check() && is_null($request['id_color']) && is_null($request['id_size']) && is_null($request['id_product'])){
            $detail = Detail::find($request['id_detail']);
            if(is_null($detail)){
                return Response::json(array('status' => 'error', 'message' => 'Product detail not found!'), 404);
            }
        
            $this->authorize('delete', $detail);
            if($detail->delete()){
                return Response::json(array('status'=>'success','message' => 'The product has been deleted from your cart!'),200);
            }else{
                return Response::json(array('status'=>'error','message' => 'An error occurred and we were unable to delete the product from your cart!'),500);
            }
        }else if(is_null($request['id_detail']) && !Auth::check() && isset($request['id_color']) && isset($request['id_size']) && isset($request['id_product'])){
            if(!$cart = $request->session()->get('cart')){
                return Response::json(array('status' => 'error', 'message' => "Don't have a shopping cart"), 404);
            }
            $i = $this->searchArray($request['id_product'], $request['id_color'], $request['id_size'], $cart);
            if($i == -1){
                return Response::json(array('status' => 'error', 'message' => "You do not have this combination product, color and size in your shopping cart!"), 404);
            }
            array_splice($cart, $i, 1);
            $request->session()->put('cart', $cart);
            return Response::json(array('status' => 'success', 'message' => 'The product has been deleted from your cart!'), 200);
        }else{
            return Response::json(array('status'=>'error', 'message'=>'Bad request!'), 400);
        }

        
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id_detail' => 'integer',
            'quantity' => 'required|integer|min:1',
            'id_color' => 'integer',
            'id_size' => 'integer',
            'id_product' => 'integer'
         ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

        if(isset($request['id_detail']) && Auth::check() && is_null($request['id_color']) && is_null($request['id_size']) && is_null($request['id_product'])){
            $detail = Detail::find($request['id_detail']);
            if(is_null($detail)){
                return Response::json(array('status' => 'error', 'message' => 'Product detail not found!'), 404);
            }
            $this->authorize('update', $detail);
        
            $detail->quantity = $request['quantity'];
            if($detail->save()){
                return Response::json(array('status'=>'success','message' => 'The quantity has changed'),200);
            }else{
                return Response::json(array('status'=>'error','message' => 'An error occurred and we were unable to change the quantity', 'quantity'=>$detail->quantity),500);
            }            

        }else if(is_null($request['id_detail']) && !Auth::check() && isset($request['quantity']) && isset($request['id_color']) && isset($request['id_size']) && isset($request['id_product'])){
            if(!$cart = $request->session()->get('cart')){
                return Response::json(array('status' => 'error', 'message' => "Don't have a shopping cart"), 404);
            }
            $i = $this->searchArray($request['id_product'], $request['id_color'], $request['id_size'], $cart);
            if($i == -1){
                return Response::json(array('status' => 'error', 'message' => "You do not have this combination product, color and size in your shopping cart!"), 404);
            }
            $cart[$i]['quantity'] = $request['quantity'];
            $request->session()->put('cart', $cart);
            return Response::json(array('status' => 'success', 'message' => 'The quantity has been updated!'), 200);
        }else{
            return Response::json(array('status'=>'error', 'message'=>'Bad request!'), 400);   
        }
    }
}