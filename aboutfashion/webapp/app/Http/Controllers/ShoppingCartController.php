<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use App\Models\Order;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class ShoppingCartController extends Controller{


    public function __construct(){
        $this->middleware('auth:web');
    }

    private function createShoppingCart(int $id_user){
        $shoppingCart = Order::where('id_user',$id_user)->where('status', 'Shopping Cart')->first();
        if(is_null($shoppingCart)){
            $shoppingCart = new Order();
            $shoppingCart->id_user = $id_user;
            $shoppingCart->save();
        }
        return $shoppingCart;
    }

    private function createDetail(int $id_order, int $id_product, int $id_color, int $id_size){
        $filters = array(['id_order',$id_order], ['id_product',$id_product], ['id_size',$id_size], ['id_color', $id_color]);
        $detail = Detail::where($filters)->first();
        if(is_null($detail)){
            $detail = new Detail();
            $detail->id_product = $id_product;
            $detail->id_color = $id_color;
            $detail->id_size = $id_size;
            $detail->quantity = 0;
            $detail->save();
        }
        return $detail;
    }

    public function addProductCart(Request $request){
        $validator = Validator::make($request->all(), [
           'id_user' => 'required|integer',
           'id_color' => 'required|integer',
           'id_size' => 'required|integer',
           'id_product' => 'required|integer'
        ]);

        if($validator->fails()){
            return Response::json(array('status'=>'error','message'=>'Bad request!'),400);
        }

        $user = User::find($request['id_user']); 
        $this->authorize('updateCart', $user);

        $shoppingCart = $this->createShoppingCart($user->id);
        $detail = $this->createDetail($shoppingCart->id, $request['id_product'],$request['id_color'],$request['id_size']);
        $detail->quantity += 1;
        $detail->save();
        return Response::json(array('status'=>'success','message'=>'Success!'), 200);
        
    }    
}