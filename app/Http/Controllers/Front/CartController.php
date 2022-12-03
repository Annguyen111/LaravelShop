<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Product;
use Cart;


class CartController extends Controller
{

    public function add(Request $request,$id){

        $product = Product::findOrFail($id);

        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $request->qty ?? 1,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,

            'options' => [
                'images' => $product->productImages,
                'color' => $request->input('color'),
                'size' => $request->input('size'),
            ],


        ]);




        return back();
    }

    public function index()
    {
       $carts = Cart::content();
       $total = Cart::total();
       $subtotal = Cart::subtotal();
        return view('fontend.shop.cart',compact('carts','total','subtotal'));
    }


    public function update(Request $request)
    {
        if ($request->ajax()){
            Cart::update($request->rowId,$request->qty);
        }


    }

    public function delete($rowId)
    {

        Cart::remove($rowId);
        return back();
    }

    public function destroy(){
        Cart::destroy();
    }
}
