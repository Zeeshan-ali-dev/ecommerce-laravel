<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\Product;
use App\Models\Order;


class AdminController extends Controller
{
    //
    public function index(){
        $totalEarnings = Order::where(['status' => FILLED])->sum('total');
        $pendingEarnings = Order::where(['status' => PENDING])->sum('total');
        $pendingOrders = Order::where(['status' => PENDING])->count();
        $completeOrders = Order::where(['status' => FILLED])->count();
        $data = [
            'total_earnings' => $totalEarnings,
            'pending_earnings' => $pendingEarnings,
            'complete_orders' => $completeOrders,
            'pending_orders' => $pendingOrders
        ];
        return view('admin.dashboard', $data);
    }

    public function users(){
        return view('admin.users.users');
    }
    
    
    public function admins(){
        $users = User::where(['role' => ADMIN])->get();
        $data['users'] = $users ? $users : '';
        return view('admin.users.users', $data);
    }
    
    
    public function customers(){
        $users = User::where(['role' => CUSTOMER])->get();
        $data['users'] = $users ? $users : '';
        return view('admin.users.users', $data);
    }

    public function products(){
        $products = Product::all();
        $data['products'] = $products ? $products : '';
        return view('admin.products.products', $data);
    }

    public function add_product(){
        return view('admin.products.addProduct');
    }

    public function edit_product($id){
        $product = Product::where(['id' => decrypt($id)])->first();
        $data['product'] = $product ? $product : '';
        // dd($product);
        return view('admin.products.editProduct', $data);
    }

    public function update_product(Request $request,$id){
        if($request->isMethod("post")){
            $name = $request->input('product_name');
            $price = $request->input("product_price");
            $description = $request->input('product_description');
            $errors = '';

            $product_img_name = time().'.'.$request->product_img->extension();
            $img = $request->product_img->move(public_path('images'), $product_img_name);

            if(!$errors){
                $product_data = [
                    'name' => $name,
                    'price' => $price,
                    'description' => $description
                ];

                if($img){
                    $product_data['img'] = $product_img_name;
                }

                $res = Product::where(['id' => decrypt($id)])->update($product_data);
                if($res){
                    return redirect()->route('edit-product', $id)->with('success', 'Product updated successfully');
                }else{
                    return redirect()->route('edit-product', $id)->with('error', 'Something went wrong!');
                }
            }
        }
    }

    public function insert_product(Request $request){
        if($request->isMethod('post')){
            $name = $request->input("product_name");
            $price = $request->input('product_price');
            $description = $request->input("product_description");
            $category = $request->input('category');
            $errors = '';

            $product_img_name = time().'.'.$request->product_img->extension();
            $img = $request->product_img->move(public_path('images'), $product_img_name);

            if(!$errors){
                $product_data = [
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'category' => $category
                ];

                if($img){
                    $product_data['img'] = $product_img_name;
                }



                $res = Product::create($product_data);
                if($res){
                    return redirect()->route('product-listing')->with('success', 'Product inserted successfully');
                }else{
                    return redirect()->route('add-product')->with("error", 'Something went wrong!');
                }
            }
        }
    }

    public function delete_product($id){
        $res = Product::find(decrypt($id))->delete();
        if($res){
            return redirect()->route('product-listing')->with('success', 'Product deleted successfully');
        }else{
            return redirect()->route('product-listing')->with('error', 'Something went wrong!');
        }
    }

    public function product_details($id){
        $product = Product::find(decrypt($id))->first();
        $data['product'] = $product ? $product : '';
        return view('admin.products.productDetails', $data);
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

            $user = User::where(['email' => $email])->first();
            if($user){
                $res = Hash::check($password, $user->password);
                if($res){
                    session()->put("is_logged_in", true);
                    session()->put("id", $user->id);
                    return redirect()->route('admin')->with("success", "you are successfully logged in");
                }else{
                    return redirect('/login')->with("error", "Invalid Credentials!!");
                }
            }else{
                return redirect('/login')->with("error", "User not found!");
            }
        }
    }

    public function orders(){
        $orders = Order::all();
        $orderList = [];
        foreach($orders as $order){
            $user = User::where(['id' => $order->user_id])->first();
            $order->user = $user;
            $orderList[] = $order;
        }

        $data['orders'] = $orderList ? $orderList : '';
        return view('admin.orders.orders', $data);
    }

    public function pending_orders(){
        $orders = Order::where(['status' => PENDING])->get();
        $orderList = [];
        foreach($orders as $order){
            $user = User::where(['id' => $order->user_id])->first();
            $order->user = $user;
            $orderList[] = $order;
        }

        $data['orders'] = $orderList ? $orderList : '';
        return view('admin.orders.orders', $data);
    }

    public function completed_orders(){
        $orders = Order::where(['status' => FILLED])->get();
        $orderList = [];
        foreach($orders as $order){
            $user = User::where(['id' => $order->user_id])->first();
            $order->user = $user;
            $orderList[] = $order;
        }

        $data['orders'] = $orderList ? $orderList : '';
        return view('admin.orders.orders', $data);
    }

    public function order_details($id = false){
        $orderId = decrypt($id);
        $order = Order::where(['id' => $orderId])->first();
        $user = User::where(['id' => $order->user_id])->first();
        $order->user = $user;
        $data['order'] = $order;
        return view('admin.orders.orderdetails', $data);
    }


    public function logout(){
        session()->flush();
        return redirect('/login');
    }


    public function encryption(){
        $num = 12345;
        echo Hash::make($num);
    }


    public function insert_subscriber(Request $request){
        if($request->isMethod("post")){
            $email = $request->input('email');
            $errors = '';
            $exist = Subscriber::find(['email' => $email])->first();
            if($exist){
                $errors .= 'Email already exists';
            }

            if(!$errors){
                $res = Subscriber::create(['email' => $email]);
                if($res){
                    return redirect()->back();
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
        }
    }


 
    public function fill_order($id){
        $orderId = decrypt($id);
        Order::where(['id' => $orderId])->update(['status' => FILLED]);
        return redirect()->route('orders')->with("success", 'Order is filled success fully');
    }



}
