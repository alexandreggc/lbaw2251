<?php

namespace App\Http\Controllers;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Product;

class PageController extends Controller{

    public function homePage(){
        $promotions = Promotion::all();
        return view('pages.home',['promotions'=>$promotions]);
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