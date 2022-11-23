<?php

namespace App\Http\Controllers;

class PageController extends Controller{

    public function homePage(){
        return view('pages.home');
    }

    public function homePageAdmin(){
        return view('pages.admin.home');
    }

    public function aboutPage(){
        return view('pages.about');
    }

    public function contactsPage(){
        return view('pages.contacts');
    }
}