<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

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

    public function shop(Request $request){
        $data = [];
        if($request->isMethod('get')){
            $cat = $request->get("cat");
            $min = $request->get("min");
            $max = $request->get("max");
            if($cat != null){
                $products = Product::where(['category' => $cat])->orderBy("id", 'desc')->get();
                $data['products'] = $products ? $products : '';
            }else if($min != null && $max != null){
                $products = Product::where('price', '>=', $min)->where('price', '<=', $max)->orderBy("id", 'desc')->get();
                $data['products'] = $products ? $products : '';
            }else{
                $products = Product::orderBy("id", 'desc')->get();
                $data['products'] = $products ? $products : '';
            }
        }
        $min_price = Product::min("price");
        $max_price = Product::max("price");
        
        $data['min_price'] = $min_price ? $min_price : '';
        $data['max_price'] = $max_price ? $max_price : '';
        return view('user.shop', $data);
    }

    public function cart(){
        if(!session()->has('is_customer')){
            return redirect()->route('home');
        }

        $cart_items = Cart::where(['user_id' => session()->get('id')])->get();
        $products = [];
        $grandTotal = 0;
        foreach($cart_items as $item){
            $product = Product::where(['id' => $item->product_id])->first();
            if($product){
                $product->quantity = $item->quantity;
                $product->cart_id = $item->id;
                $products[] = $product;
            }
        }

        foreach($products as $p){
            $grandTotal += $p->price * $p->quantity;
        }

        $data['products'] = $products? $products : '';
        $data['grandTotal'] = $grandTotal? $grandTotal : 0;

        return view('user.cart', $data);
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

    public function minus_product(Request $request){
        if($request->isMethod('post')){
            $cartId = $request->input('cart_id');
            $cartId = decrypt($cartId);
            $cart = Cart::where(['id' => $cartId ])->first();
            if($cart->quantity > 0){
                Cart::where(['id' => $cartId])->update(['quantity' => $cart->quantity - 1 ]);
                return redirect()->back();
            }else{
                Cart::where(['id' => $cartId])->delete();
                return redirect()->back();
            }
        }
    }
    public function add_product(Request $request){
        if($request->isMethod('post')){
            $cartId = $request->input('cart_id');
            $cartId = decrypt($cartId);
            $cart = Cart::where(['id' => $cartId ])->first();
            Cart::where(['id' => $cartId])->update(['quantity' => $cart->quantity + 1 ]);
            return redirect()->back();
        }
    }
    public function remove_product(Request $request){
        if($request->isMethod('post')){
            $cartId = $request->input('cart_id');
            $cartId = decrypt($cartId);
            $cart = Cart::where(['id' => $cartId ])->first();
            Cart::where(['id' => $cartId])->delete();
            return redirect()->back();

        }
    }

    public function place_order(Request $request){
        if($request->isMethod('post')){
            if(!session()->has('is_customer')){
                return redirect()->route('login');
            }

            $user_id = session()->get('id');
            $cart_items = Cart::where(['user_id' => $user_id])->get();
            $products = [];
            $grandTotal = 0;
            foreach($cart_items as $item){
                $product = Product::where(['id' => $item->product_id])->first();
                if($product){
                    $product->quantity = $item->quantity;
                    $product->cart_id = $item->id;
                    $products[] = $product;
                }
            }

            foreach($products as $p){
                $grandTotal += $p->price * $p->quantity;
            }

            $order_data = [
                'user_id' => $user_id,
                'products' => json_encode($products),
                'total' => $grandTotal,
                'status' => PENDING,
            ];

            Order::create($order_data);
            Cart::where(['user_id' => $user_id])->delete();
            return redirect()->route('home')->with('success', 'Order placed successfuly');
        }
    }
}
