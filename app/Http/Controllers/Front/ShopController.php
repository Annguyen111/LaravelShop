<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;

use App\Models\ProductLikes;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get categories
        $categories = ProductCategory::all();
        $brands = Brand::all();

        //Get products
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';

        $products = Product::where('name','like','%' . $search . '%');

        $products = $this->filter($products,$request);

        $products = $this->sortAndPagination($products,$sortBy,$perPage);
        
        if (isset(Auth::user()->id)){
            $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();
            return view('fontend.shop.index',compact('categories','brands','products','productlikes'));
        }
        
        return view('fontend.shop.index',compact('categories','brands','products'));
    }


    public function show($id)
    {

        $categories = ProductCategory::all();
        $brands = Brand::all();

            $product = Product::findOrFail($id);

            $avgRating = 0;
            $sumRating = array_sum(array_column($product->productComments->toArray(),'rating'));
            $countRating = count($product->productComments);
            if ($countRating != 0){
                $avgRating = $sumRating / $countRating;
            }
            $product->avgRating = $avgRating;

            $relatedProducts = Product::where('product_category_id',$product->product_category_id)
                                            ->where('tag',$product->tag)
                                            ->limit(4)
                                            ->get();

            return view('fontend.shop.show',compact('product','categories','brands','avgRating','relatedProducts'));
    }





    public function postComment(Request $request){
        ProductComment::create($request->all());

        return redirect()->back();
    }

    public function category($categoryName,Request $request){
        //Get categories
        $categories = ProductCategory::all();
        $brands = Brand::all();

        //Get products
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';

        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery();

        $products = $this->filter($products,$request);

        $products = $this->sortAndPagination($products,$sortBy,$perPage);

        return view('fontend.shop.index',compact('categories','brands','products'));
    }

    public function sortAndPagination($products,$sortBy,$perPage){
        switch($sortBy){
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }

        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy,'show' => $perPage]);


        return $products;
    }

    public function filter($products,Request $request){
        //Brand
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = $brand_ids != NULL ? $products->whereIn('brand_id',$brand_ids) : $products;


        //Price
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;

        $priceMin = str_replace('$','',$priceMin);
        $priceMax = str_replace('$','',$priceMax);
        $products = ($priceMin != NULL && $priceMax != NULL) ? $products->whereBetween('price',[$priceMin,$priceMax]) : $products;

        //Color
        $color = $request->color;
        $products = $color != NULL
                    ? $products->whereHas('productDetails', function ($query) use ($color) {
                        return $query->where('color', $color)->where('qty','>', 0);
                    }) : $products;

        //Size
        $size = $request->size;
        $products = $size != NULL
                    ? $products->whereHas('productDetails', function ($query) use ($size) {
                        return $query->where('size', $size)->where('qty','>', 0);
                    }) : $products;

        return $products;
    }
}
