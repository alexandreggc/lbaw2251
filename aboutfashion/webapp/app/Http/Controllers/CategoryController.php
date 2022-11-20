<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request
     * @return Response
     */
    public function create(Request $request){
        $category = store($request);
        return view('categories.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request){
        $category = new Category();
        $this->authorize('store', $category);
        //implementar esta policy store no CategoryPolicy

        $category->id = $request->input('id');
        $category->name = $request->input('name');
        $category->save();
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  Request
     * @return Response
     */
    public function edit($request){
        //implementar esta policy update no CategoryPolicy
        $category = update($request);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request
     * @return Response
     */
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

    public function getAllSuperCategories(Request $request){
        $categories = array();
        $superCategory = Category::findOrFail($request['id'])->superCategory()->get();
        while(count($superCategory) != 0){
            array_push($categories, array("id"=> $superCategory[0]['id'], "name" => $superCategory[0]['name']));
            $superCategory = Category::findOrFail($superCategory[0]['id'])->superCategory()->get();
        }
        
        return $categories;
    }

    public function getAllSubCategories(Request $request){
        $categories = array();
        $subCategory = Category::findOrFail($request['id'])->subCategory()->get();
        while(count($subCategory) != 0){
            array_push($categories, array("id"=> $subCategory[0]['id'], "name" => $subCategory[0]['name']));
            $subCategory = Category::findOrFail($subCategory[0]['id'])->subCategory()->get();
        }
        
        return $categories;
    }
}