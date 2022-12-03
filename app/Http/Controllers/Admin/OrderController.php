<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        dd($orders);
        if ($request->get('filter') != NULL){
            if ($request->get('filter') == 'finished'){
                $orders = Order::where('status',Constant::order_status_Finish)->get();

                return view('backend.order.index',compact('orders'));
            }
            if ($request->get('filter') == 'unfinished'){
                $orders = Order::whereNot('status',Constant::order_status_Finish)
                            ->get();
                return view('backend.order.index',compact('orders'));
            }
        }else{
            $orders = Order::where('first_name','like','%' . $request->get('search') . '%' )
                ->orderBy('id','desc')
                ->paginate(3);
//            $orders = Order::paginate(5);
            return view('backend.order.index',compact('orders'));
        }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.order.show',compact('order'));
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
        if ($request->input('status') == 'confirm'){
            $data = [
                'status' => Constant::order_status_Confirmed
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }

        if ($request->input('status') == 'unconfirmed'){
            $data = [
                'status' => Constant::order_status_Unconfirmed
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }

        if ($request->input('status') == 'cancel'){
            $data = [
                'status' => Constant::order_status_Cancel
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }
        if ($request->input('status') == 'processing'){
            $data = [
                'status' => Constant::order_status_Processing
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }

        if ($request->input('status') == 'shipping'){
            $data = [
                'status' => Constant::order_status_Shipping
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }

        if ($request->input('status') == 'finish'){
            $data = [
                'status' => Constant::order_status_Finish
            ];

            DB::table('orders')->where('id',$id)->update($data);

            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
