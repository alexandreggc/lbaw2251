<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;

class PageController extends Controller
{
    public function showSearchPage(){
        $categories = Category::all();
        $sizes = Size::all();
        return view('pages.searchProduct',['category'=>$categories, 'sizes'=>$sizes]);
    }

    public function homePage(){
        return view('pages.home');
    }

    public function homePageAdmin(){
        return view('pages.admin.home');
    }
}