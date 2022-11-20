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
        $super_category = Category::findOrFail($request['id'])->superCategory()->get();
        while(count($super_category) != 0){
            array_push($categories, array("id"=> $super_category[0]['id'], "name" => $super_category[0]['name']));
            $super_category = Category::findOrFail($super_category[0]['id'])->superCategory()->get();
        }
        
        return $categories;
    }

    public function getAllSubCategories(Request $request){
        $categories = array();
        $super_category = Category::findOrFail($request['id'])->subCategory()->get();
        while(count($super_category) != 0){
            array_push($categories, array("id"=> $super_category[0]['id'], "name" => $super_category[0]['name']));
            $super_category = Category::findOrFail($super_category[0]['id'])->subCategory()->get();
        }
        
        return $categories;
    }
}