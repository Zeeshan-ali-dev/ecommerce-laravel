<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class SiteController extends Controller
{
    //

    public function index(){
        $products = Product::orderBy('id', 'desc')->take(8)->get();
        $data['products'] = $products ? $products :'';
       return view('user.home', $data);
    }

    public function about(){
        return view('user.about');
    }

    public function contact(){
        return view('user.contact');
    }

    public function shop(){
        $min_price = Product::min("price");
        $max_price = Product::max("price");
        $products = Product::orderBy("id", 'desc')->get();
        $data['products'] = $products ? $products : '';
        $data['min_price'] = $min_price ? $min_price : '';
        $data['max_price'] = $max_price ? $max_price : '';
        return view('user.shop', $data);
    }

    public function cart(){
        return view('user.cart');
    }

    public function login(){
        return view('user.login');
    }

    public function login_user(Request $request){
        if($request->isMethod('post')){
            $email = $request->input('email');
            $password = $request->input('password');
           
            // preview($request->input());
            $user_data = [
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $user = User::where(['email' => $email])->first();
            if($user){
                $res = Hash::check($password, $user->password);
                if($res){
                    if($user->role == ADMIN){
                        session()->put("is_logged_in", true);
                        session()->put("id", $user->id);
                        return redirect()->route('admin')->with("success", "you are successfully logged in");
                    }else if($user->role == CUSTOMER){
                        session()->put("is_customer", true);
                        session()->put("id", $user->id);
                        return redirect()->route('home')->with("success", "you are successfully logged in");
                    }
                }else{
                    return redirect('/login')->with("error", "Invalid Credentials!!");
                }
            }else{
                return redirect('/login')->with("error", "User not found!");
            }
        }
    }

    public function signup(){
        return view("user.signup");
    }

    public function signup_user(Request $request){
        if($request->isMethod("post")){
            $email = $request->input("email");
            $password = $request->input('password');
            $errors = '';
            $user = User::where(['email' => $email])->first();
            if($user){
                $errors = $user->email == $email ? 'Email already exists' :'';
            }
            if(!$errors){
                $user_data = [
                    'name' => 'John Doe',
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => CUSTOMER
                ];
                $res = User::create($user_data);
                if($res){
                    return redirect()->route("login")->with("success", "You are registered successfully");
                }else{
                    return redirect()->route("signup")->with("error", "Something went wrong!");
                }
            }else{
                return redirect()->route('signup')->with("error", $errors);
            }
        }
    }

    public function product_details(Request $request, $id){
        $product = Product::where(['id' => decrypt($id)])->first();
        $data['product'] = $product ? $product : '';
        return view('user.product-details', $data);
    }

    public function add_to_cart(Request $request){
        if(!session()->has('is_customer')){
            return redirect()->route('login');
        }
        if($request->isMethod('post')){
            $user_id = session()->get("id");
            $product_id = $request->input('product_id');
            $product_id = decrypt($product_id);
            $cart = Cart::where(['user_id' => $user_id, 'product_id' => $product_id])->first();
            if(!$cart){
                $cart_data = [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                ];
                Cart::create($cart_data);
                return redirect()->back();
            }else{
                Cart::where(['id' => $cart->id])->update(['quantity' => $cart->quantity  + 1]);
                return redirect()->back();
            }
        }
    }
}
