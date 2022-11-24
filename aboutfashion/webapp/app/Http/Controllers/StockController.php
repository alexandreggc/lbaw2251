<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StockController extends Controller
{

    public function hasStock(int $id_product,int $id_size,int $id_color){
        return count(Stock::where('id_product', $id_product)->where('id_size', $id_size)->where('id_color', $id_color)->where('stock','>',0)) >= 1;
    }
    
    public function stockAPI(Request $request){        
        $validator = Validator::make($request->all(),[
            'id_product' => 'required|integer',
            'id_size' => 'nullable|integer',
            'id_color' => 'nullable|integer',
        ]);

        if($validator->fails()){
            return response(null, 400);
        }

        $stocks = Stock::where('id_product', $request['id_product']);
        if(!is_null($request['id_size'])){
            $stocks->where('id_size',$request['id_size']);
        }
        if(!is_null($request['id_color'])){
            $stocks->where('id_color', $request['id_color']);
        }           
        return json_encode($stocks->get());
    }
}