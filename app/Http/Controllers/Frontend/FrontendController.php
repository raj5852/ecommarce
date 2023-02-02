<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    function index()
    {
        $sliders = Slider::where('status', 0)->get();
        $trendingProducts = Product::where('trending',1)->latest()->take(15)->get();
        return view('frontend.index', compact('sliders','trendingProducts'));
    }
    function categories()
    {
        $categories = Category::where('status', 0)->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }
    function productsView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', 0)->first();
            if ($product) {
                return view('frontend.collections.products.view', compact('category','product'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    function thankyou(){
        return view('frontend.thank-you');
    }

    function newArrivals(){
        $newArrivals = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arivals',compact('newArrivals'));
    }
    function featuredProducts(){
        $featuredProducts = Product::where('featured',1)->latest()->get();
        return view('frontend.pages.featured-products',compact('featuredProducts'));
    }
}
