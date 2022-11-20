<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class PageController extends Controller
{
    public function showSearchPage(Request $request){
        $this->validate($request, [
            'category' => 'integer|required'
        ]);
        $sizes = Size::all()->orderBy('id')->get();
        return view('pages.searchProduct',['category'=>$request['category'], 'sizes'=>$sizes]);
    }
}