<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }

    public function users(){
        return view('admin.users.users');
    }
    
    
    public function retailers(){
        return view('admin.users.users');
    }
    
    
    public function customers(){
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
            $email = $request->input('email');
            $password = $request->input('password');
           

            $user_data = [
                'email' => $email,
                'password' => Hash::make($password)
            ];

            preview($user_data);
        }
    }

    public function orders(){
        return view('admin.orders.orders');
    }

    public function pending_orders(){
        return view('admin.orders.orders');
    }

    public function completed_orders(){
        return view('admin.orders.orders');
    }

    public function order_details($id = false){
        echo decrypt($id);
    }













    //  ==================== Temp ==================================
    
    public function set_session(){
        $isset = session()->has('is_logged_in');
        if($isset){
            echo 'session already set ha <br>';
        }else{
            echo 'session set ni tha <br>';
            session()->put('is_logged_in', true);
            echo session()->get('is_logged_in');
        }

    }


    public function logout(){
        session()->forget('is_logged_in');
        // echo Hash::make('12345');

        // preview(session()->all());
    }


    public function model(){
        $user = User::where(['email' => 'admin@gmail.com'])->first();
        // preview($user);
        if(Hash::check('12345', $user->password)){
            echo 'password matched';
        }else{
            echo 'Invalid password';
        }
    }


    public function checkSomething(){
        echo 'this is something';
    }



}
