<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }

    public function getAllSuperCategories(Request $request){
        $categories = array();
        $superCategory = Category::findOrFail($request['id'])->superCategory()->get();
        while(count($superCategory) != 0){
            array_push($categories, $superCategory);
            $superCategory = Category::findOrFail($superCategory[0]['id'])->superCategory()->get();
        }
        
        return $categories;
    }

    public function getAllSubCategories(Request $request){
        $categories = array();
        $unexploredCategories = new Stack();
        for($category as Category::findOrFail($request['id'])->subCategory()->get()){
            $unexploredCategories
        }
        $subCategory = Category::findOrFail($request['id'])->subCategory()->get();
        
        while(!empty($unexploredCategories)){
            
        }
        /*while(count($subCategory) != 0){
            array_push($categories, array("id"=> $subCategory[0]['id'], "name" => $subCategory[0]['name']));
            $subCategory = Category::findOrFail($subCategory[0]['id'])->subCategory()->get();
        }*/
        
        return $categories;
    }
}