<?php

namespace App\Http\Controllers;

use App\Models\Stock;

class StockController extends Controller
{

    public function hasStock(int $id_product,int $id_size,int $id_color){
        return count(Stock::where('id_product', $id_product)->where('id_size', $id_size)->where('id_color', $id_color)->where('stock','>',0)) != 0;
    }
  
}