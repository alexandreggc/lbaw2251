<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return Response //\Illuminate\Http\Response
     */
    public function create(Request $request){
        $product = new Product();
        $this->authorize('create', $product);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();
        return $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request     $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product          $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product          $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        
    }

    //QUAL A DIFERENÇA ENTRE O EDIT E O UPDATE?

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product       $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $product = Product::find($product->id); //VERIFICAR SE É ISTO MESMO
        $this->authorize('update', $product);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product          $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        $product = Product::find($product->id); //VERIFICAR SE É ISTO MESMO
        $this->authorize('delete', $product);
        $product->delete();
        return;
    }
}
