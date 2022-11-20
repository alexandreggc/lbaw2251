<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;



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

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  request containing the description
     * @return Response
     */
    public function create(Request $request){
        $product = store($request);
        return view('products.create', ['product' => $product]);
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
        $this->authorize('create', $product);
        //implementar esta policy update no ProductPolicy

        //guardar os dados do novo produto
        $product->id = $request->input('id');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
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
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request equest containing the new state
     * @return Response
     */
    public function edit(Request $request){
        $product = update($request, $id);
        return view('products.edit', ['product' => $product]);
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
        return view('products.delete');
    }  

    public function searchAPI(Request $request){        
        $this->validate($request, [
           'id_product' => 'integer',
           'id_category' => 'integer',
           'min_price' => 'numeric',
           'max_price' => 'numeric',
           'min_classification' => 'numeric',
           'product_name' => 'string'
        ]);
        

        $filters = array();
        if(!is_null($request['id_product'])){
            array_push($filters, array('id','=',$request['id_product']));
        }
        if(!is_null($request['id_category'])){
            array_push($filters, array('id_category','=',$request['id_category']));
        }
        if(!is_null($request['min_price'])){
            array_push($filters, array('price','<=',$request['min_price']));
        }
        if(!is_null($request['max_price'])){
            array_push($filters, array('price','>=',$request['max_price']));
        } 

        $query = Product::where($filters);
        
        
        if(!is_null($request['product_name'])){
            $query = $query->search($request['product_name']);
        }
        if(!is_null($request['min_classification'])){
            $query = $query->whereRaw('(SELECT avg(evaluation) FROM lbaw2251.review WHERE id_product = lbaw2251.product.id) >= ?', [$request['min_classification']])->where($filters);
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
                
            $promotionsDB = Product::find($product['id'])->promotions()->get();
            $promotions = array();
            foreach($promotionsDB as $promotion){
                $promotions[] = array("id" => $promotion['id'], "discount" => $promotion['discount'], "start_date" => $promotion['start_date'], "final_date" => $promotion['final_date']); 
            }

            $stocksDB = Product::find($product['id'])->stocks()->distinct()->get();
            $stocks = array();
            foreach($stocksDB as $stock){
                $stocks[] = array("id_size"=> $stock['id_size'], "id_color"=>$stock['id_color'], "stock"=>$stock['stock']);
            }

            $sizesDB = Product::find($product['id'])->sizes()->get();
            $sizes = array();
            foreach($sizesDB as $size){
                $sizes[] = array("id"=>$size['id'], "name"=>$size['name']);
            }
            
            $colorsDB = Product::find($product['id'])->colors()->distinct()->get();
            dump($colorsDB);
            $colors = array();
            foreach($colorsDB as $color){
                $colors[] = array("id"=>$color['id'], "name"=>$color['name']);
            }

            $productsJSON[] = array("id"=> $product['id'], "name"=>$product['name'], "description"=>$product['description'], "price"=>$product['price'], "avg_classification"=> $evaluation, "images"=>$images, "categories"=>$category, "promotions"=>$promotions, "stocks"=>$stocks, "sizes"=>$sizes, "colors" => $colors);
        } 

        return json_encode($productsJSON);
    }
}