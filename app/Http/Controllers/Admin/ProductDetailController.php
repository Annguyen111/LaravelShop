<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {

        $product = Product::find($product_id);
        $productDetails = $product->productDetails;
        return view('backend.product.detail.index',compact('product','productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = Product::find($product_id);
        return view('backend.product.detail.create',compact('product'));
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

        ProductDetail::create($data);

        $this->updateQty($product_id);


        return redirect()->route('detail.index',$product_id);
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
    public function edit($product_id,$productDetail_id)
    {
        $product = Product::find($product_id);
        $productDetail = ProductDetail::find($productDetail_id);
        return view('backend.product.detail.edit',compact('product','productDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id,$productDetail_id)
    {
        $data = $request->all();
        ProductDetail::find($productDetail_id)->update($data);
        $this->updateQty($product_id);
        return redirect()->route('detail.index',$product_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id,$productDetail_id)
    {
        ProductDetail::find($productDetail_id)->delete();
        return redirect()->route('detail.index',$product_id);
    }

    //Common method
    public function updateQty($product_id){
        $product = Product::find($product_id);
        $productDetails = $product->productDetails;

        $totalQty = array_sum(array_column($productDetails->toArray(),'qty'));

        DB::table('products')
            ->where('id',$product_id)
            ->update([
                'qty' => $totalQty
            ]);

    }
}
