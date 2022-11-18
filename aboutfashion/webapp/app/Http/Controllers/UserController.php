<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        //lista de users útil para o admin panel
        //verificar nome da view
        return view('users.index', ['users' => User::all()]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  request containing the description
     * @return Response
     */
    public function create(Request $request){
        $user = store($request, $id);
        return view('users.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param  Request
     * @return Response
     */
    public function store(Request $request, $id){
        $user = new User();
        //$this->authorize('create', $user);
        //não é necessária policy para registo
        $user->id = $request->input('id');
        $user->first_name = $request->input('first_name');
        $user->first_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->birth_date = $request->input('birth_date');
        $user->gender = $request->input('gender');
        $user->blocked = false;
        $id_image = $request->input('id_image');
        //colocar a imagem default
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        //perfil do utilizador
        //ver se é preferivel mandar id
        //talvez a mandar o user seja mais fácil apra aceder na view
        $user = User::find($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id){
        $user = update($request, $id);
        if(Auth::check()){
            return view('users.edit', ['user' => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id){
        $user = User::find($id);
        $this->authorize('update', $user);
        //implementar esta policy update no UserPolicy
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        $user = User::find($id);
        $this->authorize('delete', $user);
        //implementar esta policy delete no UserPolicy
        $user->delete();
        return view('users.delete');
    }
}