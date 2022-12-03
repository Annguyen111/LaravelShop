<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;
use App\Models\ProductLikes;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menProducts = Product::where('featured',true)->where('product_category_id',1)->get();
        $womenProducts = Product::where('featured',true)->where('product_category_id',2)->get();
        $blogs = Blog::orderBy('id','desc')->limit(3)->get();
        $sliders = Slider::all();
        if (isset(Auth::user()->id)){
            $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();
            return view('fontend.index',compact('menProducts', 'womenProducts','blogs','sliders','productlikes'));
        }
       

        return view('fontend.index',compact('menProducts', 'womenProducts','blogs','sliders'));
    }







}
