<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $product = Product::find($product_id);
        $productImages = $product->productImages;
        return view('backend.product.image.index',compact('product','productImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$product_id)
    {
        $data = $request->all();

        //Xử lí ảnh
        if ($request->hasFile('image')){
            $data['path'] = Common::uploadFile($request->file('image'),'public/fontend/img/products');
            unset($data['image']);


            ProductImage::create($data);
        }

        return redirect()->route('image.index',$product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id,$product_image_id)
    {
        //Xóa file
        $file_name = ProductImage::find($product_image_id)->path;
        if ($file_name != ''){
            unlink('public/fontend/img/products/' . $file_name);
        }

        //Xóa bản ghi trong Database
        DB::table('product_images')
            ->where('id',$product_image_id)
            ->delete();

        return redirect()->route('image.index',$product_id);
    }
}
