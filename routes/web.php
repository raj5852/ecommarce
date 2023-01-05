<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\Brand\Index;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    //category routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category}/edit','edit');
        Route::put('category/{category}','update');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('products','index');
        Route::get('products/create','create');
        Route::post('products/store','store');
    });

    Route::get('brands',Index::class);



});






Route::get('demo', function () {

    // $user = new User();
    // $user->name = "admin";
    // $user->email = "admin@gmail.com";
    // $user->password = Hash::make('admin@gmail.com');
    // $user->role_as = 1;
    // $user->save();

    return ProductImage::all();

});
