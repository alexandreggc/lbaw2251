<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;
use App\Models\Color;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        // $name = "jacket";
        // $descriptiom = "description of materials";
        // return view('products.index', compact('name', 'descriptiom'));
        // com isto conseguimos mandar parâmetros do product para a view é só usar {{ title }} e {{ description }} no html

        return view('pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  request containing the description
     * @return Response
     */
    public function create(Request $request){
        $product = store($request);
        return view('pages.products.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request){
        //rever forma de chamar as policies
        
        $product = new Product();
        $this->authorize('store', $product);
        //implementar esta policy store no ProductPolicy

        //guardar os dados do novo produto
        $product->id = $request->input('id');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        //atribuir images e categories

        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id){
        $product = Product::find($id);
        //$images = $product->images;
        return view('pages.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request request containing the new state
     * @return Response
     */
    public function edit(Request $request){
        $product = update($request, $id);
        return view('pages.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  Request
     * @return Response
     */
    public function update(Request $request, $id){
        //rever forma de chamar as policies

        $product = Product::find($id);
        $this->authorize('update', $product);
        //implementar esta policy update no ProductPolicy

        //atualizar os dados do produto
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request, $id){
        //rever forma de chamar as policies

        $product = Product::find($id);
        $this->authorize('delete', $product);
        //implementar esta policy update no ProductPolicy

        //eliminar o produto
        $product->delete();
        return view('pages.products.delete');
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
        } 

        $query = Product::where($filters);
        
        
        if(!is_null($request['product_name'])){
            $query->search($request['product_name']);
        }
        if(!is_null($request['min_classification'])){
            $query->whereRaw('(SELECT avg(evaluation) FROM lbaw2251.review WHERE id_product = lbaw2251.product.id) >= ?', [$request['min_classification']])->where($filters);
        }
        if(!is_null($request['id_size'])){
            $query->whereRelation('stocks', 'id_size', $request['id_size']);
        }
        if(!is_null($request['id_color'])){
            $query->whereRelation('stocks', 'id_color', $request['id_color']);
        }
       
        
        $products = $query->get();

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
        return view('pages.searchProduct',['categories'=>$categories, 'sizes'=>$sizes, 'colors'=>$colors]);
    }
}