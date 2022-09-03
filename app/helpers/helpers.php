<?php

use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Cart;

function preview($data){
    echo "<pre>"; print_r($data); exit;
}


function notifications(){
    if(session()->has('success')){
        echo "<div class='alert alert-success text-center'>". session()->get("success")."</div>";
    }else if(session()->has("error")){
        echo "<div class='alert alert-danger text-center'>". session()->get("error")."</div>";
    }
}


function get_user(){
    $user = User::where(['id' => session()->get('id')])->first();
    if($user){
        return $user;
    }else{
        session()->flush();
        return redirect('/admin/login')->with('error', 'You have to log in first');
    }
}

function get_cart_num(){
    if(session()->has('is_customer')){
        $user_id = session()->get("id");
        $cart_num = Cart::where(['user_id' => $user_id])->count();
    }else{
        $cart_num = 0;
    }
    return $cart_num;
}
