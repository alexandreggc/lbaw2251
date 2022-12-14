<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\Review;
use App\Models\Report;

class PageController extends Controller{

    public function homePage(){
        $promotions = Promotion::all();
        return view('pages.home',['promotions'=>$promotions]);
    }

    public function aboutPage(){
        return view('pages.about');
    }

    public function contactsPage(){
        return view('pages.contacts');
    }
}