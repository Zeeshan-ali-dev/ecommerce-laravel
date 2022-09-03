<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ================ Site Routes ==============================

Route::get("/shop", [SiteController::class, 'shop'])->name("shop");
Route::get('/', [SiteController::class, 'index'])->name("home");
Route::get('/about', [SiteController::class, 'about'])->name("about");
Route::get('/contact', [SiteController::class, 'contact'])->name("contact");
Route::get('/login', [SiteController::class, 'login'])->name("login");
Route::get('/cart', [SiteController::class, 'cart'])->name("cart");
Route::get('/p-details/{id}', [SiteController::class, 'product_details'])->name("p-details");
Route::post('/login', [SiteController::class, 'login_user'])->name('login-user');
Route::get("/signup", [SiteController::class, 'signup'])->name("signup");
Route::post("/signup-user", [SiteController::class, 'signup_user'])->name('signup-user');
Route::post("/subscribe", [AdminController::class, 'insert_subscriber'])->name("subscribe");
Route::post("/add-to-card", [SiteController::class, 'add_to_cart'])->name("add-to-cart");




// ========================== Admin Routes =====================


// Route::get('/login',  [AdminController::class, 'login']);
// Route::post('/login', [AdminController::class, 'login_user'])->name('login');
Route::middleware('isLoggedIn')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name("admin");
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/products', [AdminController::class, 'products'])->name('product-listing');
    Route::get('/add-product', [AdminController::class, 'add_product'])->name('add-product');
    Route::post('/insert-product', [AdminController::class, 'insert_product'])->name('insert-product');
    Route::get('/edit-product/{id}', [AdminController::class, 'edit_product'])->name('edit-product');
    Route::post('/update-product/{id}', [AdminController::class, 'update_product'])->name('update-product');
    Route::get('/delete-product/{id}',  [AdminController::class, 'delete_product'])->name('delete-product');
    Route::get('/product-details/{id}',  [AdminController::class, 'product_details'])->name('product-details');
    Route::get('/user-details/{id}',  [AdminController::class, 'user_details'])->name('user-details');
    Route::get('/profile-settings',  [AdminController::class, 'profile_settings'])->name('profile-settings');
    Route::get('/orders',  [AdminController::class, 'orders'])->name('orders');
    Route::get('/pending-orders',  [AdminController::class, 'pending_orders'])->name('pending-orders');
    Route::get('/completed-orders',  [AdminController::class, 'completed_orders'])->name('completed-orders');
    Route::get('/order-details/{id}',  [AdminController::class, 'order_details'])->name('order-details');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
});







// ================= Temp =======================

Route::get('/session', [AdminController::class, 'set_session']);
Route::get('/destroy', [AdminController::class, 'logout']);
Route::get('/model', [AdminController::class, 'model']);
Route::get('/check', [AdminController::class, 'checkSomething'])->middleware('isLoggedIn');
Route::get('/crypt', [AdminController::class, 'encryption']);
