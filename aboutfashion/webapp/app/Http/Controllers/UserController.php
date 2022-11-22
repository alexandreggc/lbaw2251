<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
    public function index(){
        return view('users.index', ['users' => User::all()]); 
    }


    public function show($id){
        $user = User::find($id);
        if(is_null($user)){
            return abort('404');
        }
        $this->authorize('view', $user);
        return view('pages.user.show', ['user' => $user]);
    }

    public function edit($id){
        $user = User::find($id);
        if(is_null($user)){
            return abort('404');
        }
        $this->authorize('update', $user);
        return view('pages.user.edit', ['user' => $user]);

    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return abort('404');
        }
        $this->authorize('update', $user);
        
        $validator = Validator::make($request->all(),[
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:authenticated_user,email',
            'password' => 'nullable|string|min:6|confirmed',
            'birth_date' => 'nullable|date',
            'gender' => 'string|regex:/^[PBMFO]$/',
        ]);

        if($validator->fails()){
            return redirect()->back(); // Adicionar as mensagens de erro
        }
 
        
        if(!is_null($request['first_name'])){
            $user->first_name = $request['first_name'];
        }
        if(!is_null($request['last_name'])){
            $user->last_name = $request['last_name'];
        }
        if(!is_null($request['email'])){
            $user->email = $request['email'];
        }
        if(!is_null($request['password'])){
            $user->password = bcrypt($request['password']);
        }
        if(!is_null($request['birth_date'])){
            $user->birth_date = $request['birth_date'];
        }
        if($request['gender'] == 'B'){
            $user->gender = null;
        }else if($request['gender'] == 'P'){
        }else{
            $user->gender = $request['gender'];
        }
        
        $user->save();
        return Redirect::route('userView', array('id' => $user->id));
    }

    public function delete(Request $request, int $id){
        $user = User::find($request['id']);
        if(is_null($user)){
            return abort('404');
        }

        $this->authorize('delete', $user);
        $deleted = $user->delete();
        if($deleted)
            return redirect('/');
        else
            return redirect()->back(); // Adicionar mensagens de erro
    }
}