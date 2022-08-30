<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //

    public function index(){
       return view('user.home');
    }

    public function about(){
        return view('user.about');
    }

    public function contact(){
        return view('user.contact');
    }

    public function shop(){
        return view('user.shop');
    }

    public function cart(){
        return view('user.cart');
    }

    public function login(){
        return view('user.login');
    }

    public function product_details(){
        return view('user.product-details');
    }
}
