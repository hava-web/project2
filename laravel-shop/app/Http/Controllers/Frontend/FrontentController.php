<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontentController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivalProducts = Product::latest()->take(4)->get();
        return view('frontend.index',compact('sliders','trendingProducts','newArrivalProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();

        if($category)
        {
            return view('frontend.collections.products.index',compact('category')); 
        }
        else
        {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();

        if($category)
        {
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {

                 return view('frontend.collections.products.view',compact('category','product')); 
            }
            else
            {
                return redirect()->back;
                // return "Have some error";
            }

        }
        else
        {
            return redirect()->back();
        }
    }

    public function orderSuccess()
    {
        return view('frontend.order-success');
    }

    public function newArrivals()
    {
        $newArrivalProducts = Product::latest()->take(3)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalProducts'));
    }
}
