<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

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
        $filters = array();
        if(!is_null($request['product_id'])){
            array_push($filters, array('id','=',$request['product_id']));
        }
        if(!is_null($request['category_id'])){
            array_push($filters, array('id_category','=',$request['category_id']));
        }
        if(!is_null($request['min_price'])){
            array_push($filters, array('price','<=',$request['min_price']));
        }
        if(!is_null($request['max_price'])){
            array_push($filters, array('price','>=',$request['max_price']));
        } 


        $products = Product::search($request['product_name'])->whereRaw('(SELECT avg(evaluation) FROM lbaw2251.review WHERE id_product = lbaw2251.product.id) >= ?', [$request['min_classification']])->where($filters)->get();    

        return json_encode($products);
    }
}