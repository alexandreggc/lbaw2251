<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{


    public function create(Request $request){
        $category = store($request);
        return view('categories.create', ['category' => $category]);
    }

    public function store(Request $request){
        $category = new Category();
        $this->authorize('store', $category);
        //implementar esta policy store no CategoryPolicy

        $category->id = $request->input('id');
        $category->name = $request->input('name');
        $category->save();
        return $category;
    }


    public function edit($request){
        //implementar esta policy update no CategoryPolicy
        $category = update($request);
        return view('categories.edit', ['category' => $category]);
    }


    public function update(Request $request){
        $category = Category::find($request->input('id'));
        $this->authorize('update', $category);
        //implementar esta policy update no CategoryPolicy

        $category->name = $request->input('name');
        $category->save();
        return $category;
    }

    public function destroy(Request $request){
        $category = Category::find($request->input('id'));
        $this->authorize('delete', $category);
        //implementar esta policy delete no CategoryPolicy

        $category->delete();
        return $category;
    }

    
}