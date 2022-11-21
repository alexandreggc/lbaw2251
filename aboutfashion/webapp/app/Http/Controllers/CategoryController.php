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
        $superCategory = Category::findOrFail($id)->superCategory()->get();
        while(count($superCategory) != 0){
            array_push($categories, $superCategory);
            $superCategory = Category::findOrFail($superCategory[0]['id'])->superCategory()->get();
        }
        
        return $categories;
    }

    public function getAllSubCategories($id){
        $categories = array();
        $unexploredCategories = array();

        do{
            $categoriesDB = Category::findOrFail($id)->subCategories()->get();
            if(count($categoriesDB) != 0){
                foreach($categoriesDB as $category){
                    array_push($unexploredCategories,$category['id']);
                    array_push($categories, $category);
                }   
            }
            
            if(count($unexploredCategories) == 0){
                break;
            }else{
                $id = $unexploredCategories[0];
                array_splice($unexploredCategories, 0, 1);
            }
            
        }while(true);    
        return $categories;
    }
}