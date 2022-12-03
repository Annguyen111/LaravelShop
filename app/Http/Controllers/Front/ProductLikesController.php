<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductLikesController extends Controller
{

    public function index(){

        $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();

        return view('fontend.product_likes.index',compact('productlikes'));
    }

    public function like($idProduct)
    {
        $product = Product::find($idProduct);

        $like = ProductLikes::where('user_id', Auth::user()->id)
            ->where('product_id', $idProduct)
            ->first();

        if ($like != null) {

            ProductLikes::where('id',$like->id)->delete();
            return redirect()->back();
        } else {


             ProductLikes::create(
                [
                    'user_id' => Auth::user()->id,
                    'product_id' => $idProduct,
                ]);
             return redirect()->route('like.index');

        }
    }
}
