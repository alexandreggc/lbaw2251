<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function deleteUser(Request $request, $id){
        //$this->authorize('deleteUser');
        $user = User::find($id);
        $user->delete();
        return redirect(route('homeAdminPanel')); 
    }

    public function blockUser(Request $request, $id){
        $user = User::find($id);
        //$this->authorize('blockUser'); //TODO
        $user->blocked = $user->blocked ? 0 : 1;
        $user->save();        
        return redirect(route('homeAdminPanel'));
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


    public function show(Admin $admin)
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