<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\Review;
use App\Models\Report;

use Illuminate\Http\Request;

class AdminPanelController extends Controller{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    //Users

    public function usersPageAdmin(){
        $users = User::paginate(15);
        return view('pages.admin.users', ['users'=>$users]);
    }

    public function userPurchaseHistoryPageAdmin($id){
        $user = User::find($id);
        if(is_null($user)){
            return abort('404');
        }
        return view('pages.admin.userPurchaseHistory', ['user'=>$user]);
    }

    //Products

    public function productsPageAdmin(){
        $products = Product::paginate(15);
        return view('pages.admin.products', ['products'=>$products]);
    }

    // Promotions

    public function promotionsPageAdmin(){
        $promotions = Promotion::paginate(15);
        return view('pages.admin.promotions', ['promotions'=>$promotions]);
    }

    // Orders

    public function ordersPageAdmin(){
        $orders = Order::paginate(15);
        return view('pages.admin.orders', ['orders'=>$orders]);
    }

    // Reviews

    public function reviewsPageAdmin(){
        $reviews = Review::paginate(15);
        return view('pages.admin.reviews', ['reviews'=>$reviews]);
    }

    // Reports

    public function reportsPageAdmin(){
        $reports = Report::paginate(15);
        return view('pages.admin.reports', ['reports'=>$reports]);
    }
}