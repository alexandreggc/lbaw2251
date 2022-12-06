<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\Review;
use App\Models\Report;


class AdminPanelController extends Controller{

    public function homePageAdmin(){
        //por default /admin-panel aparecerá a página de users
        // ver se é melhor fazer um redirect para /admin-panel/users e criar uma nova página de admin home para n ser direto
        $users = User::all();
        return view('pages.admin.home', ['users'=>$users]);
    }

    /*public function usersPageAdmin(){
        $users = User::all();
        return view('pages.admin.users', ['users'=>$users]);
    }*/

    public function productsPageAdmin(){
        $products = Product::all();
        return view('pages.admin.products', ['products'=>$products]);
    }

    public function promotionsPageAdmin(){
        $promotions = Promotion::all();
        return view('pages.admin.promotions', ['promotions'=>$promotions]);
    }

    public function ordersPageAdmin(){
        $orders = Order::all();
        return view('pages.admin.orders', ['orders'=>$orders]);
    }

    public function reviewsPageAdmin(){
        $reviews = Review::all();
        return view('pages.admin.reviews', ['reviews'=>$reviews]);
    }

    public function reportsPageAdmin(){
        $reports = Report::all();
        return view('pages.admin.reports', ['reports'=>$reports]);
    }
}