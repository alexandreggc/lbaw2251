<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{
    

    public function create(Request $request){
        $this->authorize('updateProduct');
        return view('pages.products.create');
    }

    public function update(Request $request){
    }

    public function store(Request $request){
    }

    public function delete($id){
        if(!is_numeric($id)){
            return Response::json(array('status' => 'error', 'message'=>'Bad request!'),400);
        }

        $product = Product::find($id);
        if(is_null($product)){
            return Response::json(array('status' => 'error', 'message' => 'Product not found!'), 404);
        }
        $this->authorize('updateProduct', $product);

        if($product->delete()){
            return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        }
    }

    public function show($id){
        $product = Product::findOrFail($id);
        $user = Auth::user(); 
        if(isset($user)){
            if(count($user->wishlist()->where('id_product', $id)->get()) != 0){
                return view('pages.products.show',['product' => $product, 'wishlist'=>true]);
            }else{
                return view('pages.products.show',['product' => $product, 'wishlist'=>false]);
            }
        }
        return view('pages.products.show',[ 'product' => $product]);
    }

    public function searchAPI(Request $request){        
       $validator = Validator::make($request->all(),[
           'id_product' => 'nullable|integer',
           'id_category' => 'nullable|integer',
           'id_size' => 'nullable|integer',
           'id_color' => 'nullable|string',
           'min_price' => 'nullable|numeric',
           'max_price' => 'nullable|numeric',
           'min_classification' => 'nullable|numeric',
           'product_name' => 'nullable|string',
           'order' => 'nullable|string'
        ]);

        if($validator->fails()){
            return Response()->json(['status'=>'BAD REQUEST', 'msg'=>'Some or all arguments entered are not correct'],400);
        }
        

        $filters = array();
        if(!is_null($request['id_product'])){
            array_push($filters, array('id','=',$request['id_product']));
        }
        if(!is_null($request['id_category'])){
            array_push($filters, array('id_category','=',$request['id_category']));
        }
        if(!is_null($request['min_price'])){
            array_push($filters, array('price','>=',$request['min_price']));
        }
        if(!is_null($request['max_price'])){
            array_push($filters, array('price','<=',$request['max_price']));
        }if(!is_null($request['min_classification'])){
            array_push($filters, array('avg_classification','<=',$request['min_classification']));
        } 
        $query = Product::where($filters);
        if(!is_null($request['product_name'])){
            $query->search($request['product_name']);
        }
        if(!is_null($request['id_size'])){
            $query->whereRelation('stocks', 'id_size', $request['id_size']);
        }
        if(!is_null($request['id_color'])){
            $query->whereRelation('stocks', 'id_color', $request['id_color']);
        }
       
        if($request['order'] == 'price_asc'){
            $products = $query->orderBy('price', 'ASC')->get();
        }else if($request['order'] == 'price_desc'){
            $products = $query->orderBy('price', 'DESC')->get();
        }else if($request['order'] == 'avg_desc'){
            $products = $query->orderBy('avg_classification', 'DESC')->get();
        }else if($request['order'] == 'name_asc'){
            $products = $query->orderBy('name', 'ASC')->get();
        }else if($request['order'] == 'name_desc'){
            $products = $query->orderBy('name', 'DESC')->get();
        }
        else{
            $products = $query->get();
        }

        $productsJSON = array();

        foreach($products as $product){
            $evaluation = Product::find($product['id'])->reviews()->avg('evaluation');
            
            $imageDB = Product::find($product['id'])->images()->get();
            $images = array();
            foreach($imageDB as $image){
                $images[] = $image['file'];
            }

            $categoryDB = Product::find($product['id'])->category()->get();
            $category = array("id" => $categoryDB[0]['id'], "name" => $categoryDB[0]['name']);
                
            $localTime = date('Y-m-d H:i:s');
            $promotions = Product::find($product['id'])->promotions()->where('start_date','<=',$localTime)->where('final_date','>=',$localTime)->orderBy('discount', 'DESC')->get();
            $promotion = array();
            if(count($promotions) != 0){
                $promotion = array("id"=>$promotions[0]['id'],"discount"=>$promotions[0]['discount'],"start_date"=>$promotions[0]['start_date'], "final_date"=>$promotions[0]['final_date']);
            }

            $productsJSON[] = array("id"=> $product['id'], "name"=>$product['name'], "description"=>$product['description'], "price"=>$product['price'], "avg_classification"=> $evaluation, "images"=>$images, "category"=>$category, "promotion"=>$promotion);
        } 

        return json_encode($productsJSON);
    }

    public function showSearchPage(){
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $user = Auth::user(); 
        if(is_null($user)){
            return view('pages.searchProduct',['order'=>null, 'categories'=>$categories, 'sizes'=>$sizes, 'colors'=>$colors]);   
        }
        return view('pages.searchProduct',[ 'categories'=>$categories, 'sizes'=>$sizes, 'colors'=>$colors, 'order' => $user->orders->where('status', 'Shopping Cart')->first()]);
    }
}