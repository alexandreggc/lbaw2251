<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;

class PageController extends Controller
{
    public function showSearchPage($id){
        $category = Category::findOrFail($id);
        $sizes = Size::all();
        return view('pages.searchProduct',['category'=>$category, 'sizes'=>$sizes]);
    }
}