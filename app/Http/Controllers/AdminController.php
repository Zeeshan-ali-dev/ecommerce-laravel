<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }

    public function users(){
        return view('admin.users.users');
    }

    public function products(){
        return view('admin.products.products');
    }

    public function add_product(){
        return view('admin.products.addProduct');
    }


    public function user_details($id){
        return view('admin.users.userDetails');
    }

    public function profile_settings(){
        return view('admin.settings.profileSettings');
    }

    public function login(){
        return view('admin.login');
    }

    public function login_user(Request $request){
        if($request->isMethod('post')){
            preview($request->input("email"));
        }
    }


}
