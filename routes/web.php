<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;

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




/* Admin route */
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class,'index'])->name('login_form');

    Route::post('/login/owner',[AdminController::class,'Login'])->name('admin.login');

    Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/register',[AdminController::class,'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class,'AdminRegisterCreate'])->name('admin.register.create');
    Route::get('/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');


    });



/* Seller route */
Route::prefix('seller')->group(function(){
    Route::get('/login',[SellerController::class,'index'])->name('seller_login_form');
    Route::get('/dashboard',[SellerController::class,'SellerDashboard'])->name('seller.dashboard')->middleware('seller');

    Route::post('/login/owner',[SellerController::class,'SellerLogin'])->name('seller.login');
    Route::get('/register',[SellerController::class,'SellerRegister'])->name('seller.register');
    Route::post('/register/create',[SellerController::class,'SellerRegisterCreate'])->name('seller.register.create');

     Route::get('/logout',[SellerController::class,'SellerLogout'])->name('seller.logout');


    });





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';