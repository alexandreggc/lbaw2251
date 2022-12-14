<?php

namespace App\Http\Controllers;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user(); 
        if(is_null($user)){
            return view('pages.about',['order'=>null]);   
        }
        return view('pages.about',[ 'order' => $user->orders->where('status', 'Shopping Cart')->first()]);
    }

    public function contactsPage(){
        $user = Auth::user(); 
        if(is_null($user)){
            return view('pages.contacts',['order'=>null]);   
        }
        return view('pages.contacts',[ 'order' => $user->orders->where('status', 'Shopping Cart')->first()]);
    } 
}