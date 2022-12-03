<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $sql1 = 'select * from v_user';
        $sql2 = 'select * from v_ordertotal';
        $sql3 = 'select * from v_ordersales';
        $sql4 = 'select * from v_products';


        $users = DB::select($sql1);
        $orders = DB::select($sql2);
        $sales = DB::select($sql3);
        $products = DB::select($sql4);
        return view('backend.dashboard.index',compact('users','orders','sales','products'));
    }
}
