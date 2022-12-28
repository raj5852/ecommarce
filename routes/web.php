<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
    // return DB::select('SHOW TABLES');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);

    //category routes
    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/create',[CategoryController::class,'create']);
    Route::post('category',[CategoryController::class,'store']);

});






Route::get('demo',function(){
   return $data =  User::find(19);
    // $data->role_as = 1;
    // $data->save();


});
