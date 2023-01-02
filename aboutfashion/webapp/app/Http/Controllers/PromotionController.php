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
        $products = Product::all();
        return view('pages.admin.addPromotion', array('products' => $products));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            //alterar para array de ids pois é suposto ser vários produtos
            'id_product' => 'required|integer',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'final_date' => 'required|date',
        ]);
        
        if($validator->fails()){
            Redirect::back()->withErrors();
        }

        // fazer foreach para verificar se todos os produtos existem
        // quando for recebido um array
        if(!$product = Product::find($request->input('id_product'))){
            Redirect::back()->withErrors();
        };

        $promotion = new Promotion();
        
        $this->authorize('createPromotion', Auth::guard('admin')->user());
        
        $promotion->discount = $request->input('discount');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('final_date');
        
        if($promotion->save()){
            //fazer foreach e em cada product é que se adiciona a promo - fazer no final do save talvez?
            $product = Product::find($request->input('id_product'));
            //$promotion->products()->attach($product); -- isto funciona??
            $product->id_category = $promotion->id;

            return Redirect::route('promotionsAdminPanel');
        }else{
            Redirect::back()->withErrors();
        }
    }

    public function edit(Request $request){
        $this->authorize('updatePromotion', Auth::guard('admin')->user());
        $promotion = Promotion::find($request->id);
        $products = Product::all();
        return view('pages.admin.editPromotion', ['promotion'=>$promotion, 'products' => $products]);
    }

    public function update(Request $request, $id){
        if(!$promotion = Promotion::find($id)){
            Redirect::back()->withErrors();
        }
        $this->authorize('updatePromotion', Auth::guard('admin')->user());

        $validator = Validator::make($request->all(),[
            //alterar para array de ids pois é suposto ser vários produtos
            'id_product' => 'required|integer',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'final_date' => 'required|date',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors();
        }

        // fazer foreach para verificar se todos os produtos existem
        // quando for recebido um array
        if(!$product = Product::find($request->input('id_product'))){
            Redirect::back()->withErrors();
        };

        $promotion->discount = $request->input('discount');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('final_date');

        if ($product->save()) {
            //fazer foreach e em cada product é que se adiciona a promo - fazer no final do save talvez?
            $product = Product::find($request->input('id_product'));
            //$promotion->products()->attach($product); -- isto funciona??
            $product->id_category = $promotion->id;


            return Redirect::route('productsAdminPanel');
        } else {
            return Redirect::back()->withErrors();
        }
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