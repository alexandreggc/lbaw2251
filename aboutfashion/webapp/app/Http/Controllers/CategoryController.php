<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller{


    public function create(Request $request){
        $this->authorize('updateCategory', Auth::guard('admin')->user());
        $categories = Category::all();
        return view('pages.admin.addCategory', array('categories' => $categories));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|max:30',
            'id_super_category' => 'nullable|integer',
        ]);
        
        if($validator->fails()){
            Redirect::back()->withErrors();
        }

        $category = new Category();
        
        $this->authorize('createCategory', Auth::guard('admin')->user());
    
        $category->name = $request->input('name');
        if(!is_null($request->input('id_super_category'))){
            if(!$super_category = Category::find($request->input('id_super_category'))) {
                Redirect::back()->withErrors();
            }
            $category->id_super_category = $request->input('id_super_category');
        }
        
        if($category->save()){
            return Redirect::route('categoriesAdminPanel');
        } else {
            Redirect::back()->withErrors();
        }
    }


    public function edit($request){
        $this->authorize('updateCategory', Auth::guard('admin')->user());
        $category = Category::find($request->id);
        $categories = Category::all();
        return view('pages.admin.editProduct', ['category' => $category, 'categories' => $categories]);
    }


    public function update(Request $request , $id){
        if(!$category = Category::find($id)){
            Redirect::back()->withErrors();
        }
        $this->authorize('updateCategory', Auth::guard('admin')->user());

        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|max:30',
            'id_super_category' => 'nullable|integer',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors();
        }

        $category['name'] = $request->input('name');
        $category['id_super_category'] = $request->input('id_super_category');

        if ($Category->save()) {
            return Redirect::route('categoriesAdminPanel');
        } else {
            return Redirect::back()->withErrors();
        }
    }

    public function delete($id){
        if(!is_numeric($id)){
            return Response::json(array('status' => 'error', 'message'=>'Error!'),400);
        }

        $this->authorize('updateCategory', Auth::guard('admin')->user());
        $category = Category::find($id);
        if(is_null($category)){
            return Response::json(array('status' => 'error', 'message' => 'Product not found!'), 404);
        }

        if($category->delete()){
            return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        }
    }

    
}