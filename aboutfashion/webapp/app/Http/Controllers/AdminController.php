<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function show($id)
    {
        if(!is_numeric($id)){
            abort(404);
        }
        
        $admin = Admin::find($id);
        $this->authorize('view', $admin);
        return view('pages.admin.home', array('admin'=>$admin));
    }


    public function deleteUser(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|int',
        ]); 

        if($validator->fails()){
            return Response::json(array('status' => 'error', 'message'=>'Bad request!'),400);
        }

        $admin = Auth::guard('admin')->user();
        $this->authorize('updateUser', $admin);
        $user = User::find($request['id']);
        if($user->delete()){
            return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        }
    }

    public function blockUser(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|int',
        ]); 

        if($validator->fails()){
            return Response::json(array('status' => 'error', 'message'=>'Bad request!'),400);
        }
        $this->authorize('blockUser');
        
        $user = User::find($request['id']);
        $user->blocked = $user->blocked ? 0 : 1;
        if($user->save()){
            return Response::json(array('status' => 'success', 'message'=>'OK!'),200);
        }else{
            return Response::json(array('status' => 'error', 'message'=>'Something happens!'),500);
        }      
    }
    
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    
    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }


    public function destroy(Admin $admin)
    {
        //
    }
}