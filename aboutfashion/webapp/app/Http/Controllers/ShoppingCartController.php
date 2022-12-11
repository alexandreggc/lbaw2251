<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class ShoppingCartController extends Controller{


    public function show(){
        $user = Auth::user(); 
        if(is_null($user)){
            return view('pages.user.shopping_cart', array('order'=>null));   
        }
        return view('pages.user.shopping_cart', array('order' => $user->orders->where('status', 'Shopping Cart')->first()));
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

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
           'id_color' => 'required|integer',
           'id_size' => 'required|integer',
           'id_product' => 'required|integer'
        ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

        $user = Auth::user();

        $shoppingCart = $this->createShoppingCart($user->id);
        $detail = $this->createDetail($shoppingCart->id, $request['id_product'],$request['id_color'],$request['id_size']);
        if(is_null($detail)){
            return Response::json(array('status'=>'error','message' => 'An error occurred and we were unable to add the product to your cart!'),500);
        }
        $detail->quantity += 1;
        
        if($detail->save()){
            return Response::json(array('status'=>'success','message' => 'The product has been added from your cart!'),200);
        }else{
            return Response::json(array('status'=>'error','message' => 'An error occurred and we were unable to add the product to your cart!'),500);
        } 
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'id_detail' => 'required|integer',
         ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

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
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id_detail' => 'required|integer',
            'quantity' => 'required|integer|min:1'
         ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

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
    }
}