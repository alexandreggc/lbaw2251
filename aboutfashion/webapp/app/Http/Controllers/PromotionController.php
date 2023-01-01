<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller{
    
    public function create(Request $request){
        $this->authorize('updatePromotion', Auth::guard('admin')->user());
        $cproducts = Product::all();
        return view('pages.admin.addPromotion', array('products' => $products));
    }

    public function store(Request $request){
    }

    public function edit(Request $request){
        $this->authorize('updatePromotion', Auth::guard('admin')->user());
        $promotion = Promotion::find($request->id);
        $products = Product::all();
        return view('pages.admin.editPromotion', ['promotion'=>$promotion, 'products' => $products]);
    }

    public function update(Request $request){
    }

    public function delete($id){
        if(!is_numeric($id)){
            return Response::json(array('status' => 'error', 'message'=>'Bad request!'),400);
        }

        $this->authorize('updatePromotion', Auth::guard('admin')->user());
        $promotion = Promotion::find($id);
        if(is_null($promotion)){
            return Response::json(array('status' => 'error', 'message' => 'Promotion not found!'), 404);
        }

        if($promotion->delete()){
            return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        }
    }
}