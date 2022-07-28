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

Route::get('/', [SiteController::class, 'index']);
Route::get('/about', [SiteController::class, 'about']);
Route::get('/contact', [SiteController::class, 'contact']);





// ========================== Admin Routes =====================


Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name("admin");
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/products', [AdminController::class, 'products'])->name('product-listing');
    Route::get('/add-product', [AdminController::class, 'add_product'])->name('add-product');
    Route::get('/user-details/{id}',  [AdminController::class, 'user_details'])->name('user-details');
    Route::get('/profile-settings',  [AdminController::class, 'profile_settings'])->name('profile-settings');
    Route::get('/login',  [AdminController::class, 'login']);
    Route::post('/login', [AdminController::class, 'login_user'])->name('login');
});


Route::get('/session', [AdminController::class, 'set_session']);
Route::get('/destroy', [AdminController::class, 'logout']);
Route::get('/model', [AdminController::class, 'model']);
Route::get('/check', [AdminController::class, 'checkSomething'])->middleware('isLoggedIn');
