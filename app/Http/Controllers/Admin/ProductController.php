<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $products = Product::where('name','like','%' . $request->get('search') . '%' )
            ->orderBy('id','desc')
            ->paginate(5)
            ->appends(['search' => $request->get('search')]);
        return view('backend.product.index',compact('products'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = ProductCategory::all();

        return view('backend.product.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['qty'] = '0'; //Khi tạo mới sản phẩm, số lượng bằng 0
        $product = Product::create($data);

        return redirect()->route('product.show',$product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('backend.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);

        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('backend.product.edit',compact('brands','product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = [

            'brand_id' => $request->brand_id,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'content' => $request->contentt,
            'price' => $request->price,
            'discount' => $request->discount,
            'weight' => $request->weight,
            'sku' => $request->sku,
            'tag' => $request->tag,
            'featured' => $request->featured,
            'description' => $request->description

        ];
        DB::table('products')
            ->where('id',$id)
            ->update($data);

        return redirect()->route('product.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $file_name = ProductImage::where('product_id',$id)->first()->path;

        if ($file_name != ''){
            unlink('public/fontend/img/products/' . $file_name);
        }

        //Xóa bản ghi trong Database

        DB::table('product_images')
            ->where('product_id',$id)
            ->delete();

        DB::table('product_details')
            ->where('product_id',$id)
            ->delete();

        DB::table('product_comments')
            ->where('product_id',$id)
            ->delete();

//        ProductDetail::find($product->productDetails->id)->delete();

        DB::table('products')
            ->where('id',$id)
            ->delete();

        return redirect()->route('product.index');
    }

//    public function search(Request $request){
//        $products = DB::table('products')
//            ->where('name','like','%' . $request->search . '%')
//            ->orderBy('id','desc')
//            ->get();
//        return view('backend.product.index',compact('products'));
//    }
}
