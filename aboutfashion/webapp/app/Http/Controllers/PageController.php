<?php

namespace App\Http\Controllers;

use App\Models\User;

class PageController extends Controller{

    public function homePage(){
        return view('pages.home');
    }

    public function homePageAdmin(){
        $users = User::all();
        return view('pages.admin.home', ['users'=>$users]);
    }

    public function aboutPage(){
        return view('pages.about');
    }

    public function contactsPage(){
        return view('pages.contacts');
    }
}