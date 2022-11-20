<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Category;

class PageController extends Controller
{
    public function showSearchPage(){
        $categories = Category::all()->orderBy('id')->get();
        $sizes = Size::all()->orderBy('id')->get();
        return view('pages.',['categories'=>$categories, 'sizes'=>$sizes]);
    }
}