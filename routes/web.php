<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Livewire\Admin\Brand\Index;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Demo;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index']);
Route::get('collections', [FrontendController::class, 'categories']);
Route::get('collections/{category_slug}', [FrontendController::class, 'products']);
Route::get('collections/{category_slug}/{product_slug}', [FrontendController::class, 'productsView']);


Route::get('new-arrivals',[FrontendController::class,'newArrivals']);
Route::get('featured-products',[FrontendController::class,'featuredProducts']);
Route::get('search',[FrontendController::class,'searchProduct']);



Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::get('cart', [CartController::class, 'index']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{orderId}', [OrderController::class, 'show']);

    Route::get('profile',[FrontendUserController::class,'index']);
    Route::post('profile',[FrontendUserController::class,'updateUserDetails']);
    Route::get('change-password',[FrontendUserController::class,'passwordCreate']);
    Route::post('change-password',[FrontendUserController::class,'changepassword']);
});

Route::get('thank-you',[FrontendController::class,'thankyou']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('settings',[SettingController::class,'index']);
    Route::post('settings',[SettingController::class,'store']);


    Route::controller(SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/store', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider_id}', 'update');
        Route::get('sliders/{slider}/delete', 'delete');
    });


    //category routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category}/edit', 'edit');
        Route::put('category/{category}', 'update');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index');
        Route::get('products/create', 'create');
        Route::post('products/store', 'store');
        Route::get('products/{product}/edit', 'edit');
        Route::put('products/{product}', 'update');
        Route::get('product-image/{Product_image_id}/delete', 'destroyImage');
        Route::get('products/{product_id}/delete', 'destroy');
    });
    Route::get('brands', Index::class);


    Route::controller(ColorController::class)->group(function () {
        Route::get('colors', 'index');
        Route::get('colors/create', 'create');
        Route::post('colors/store', 'store');
        Route::get('colors/{color_id}/edit', 'edit');
        Route::get('colors/{color_id}/delete', 'destroy');
        Route::put('colors/{color_id}', 'update');
        Route::post('product-color/{product_color_id}', 'UpdateProductColorQty');
        Route::get('product-color/{product_color_id}/delete', 'deleteProductColor');
    });

    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::get('orders/{orderId}', 'show');
        Route::put('orders/{orderId}', 'update');

        Route::get('invoice/{orderId}','viewInvoice');
        Route::get('invoice/{orderId}/generate','generateInvoice');
        Route::get('invoice/{orderId}/mail','mailInvoice');
    });

    Route::get('users',[UserController::class,'index']);
    Route::get('users/create',[UserController::class,'create']);
    Route::post('users',[UserController::class,'srore']);
    Route::get('users/{user_id}/edit',[UserController::class,'edit']);
    Route::put('users/{user_id}',[UserController::class,'update']);
    Route::get('users/{user_id}/delete',[UserController::class,'delete']);


});








Route::get('demo', function () {

    // $user = new User();
    // $user->name = "admin";
    // $user->email = "admin@gmail.com";
    // $user->password = Hash::make('admin@gmail.com');
    // $user->role_as = 1;
    // $user->save();

    // return Slider::all();

    // return Brand::all();
    // Wishlist::find(2)->delete();
    // return Cart::all();
    // return Cart::query()->delete();
    // return Demo::create([
    //     'amount'=>100
    // ]);
    // return "ok";
    //   return Order::all();
        // return Product::all();
        return Setting::all();
});
