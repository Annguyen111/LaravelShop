<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Models\Order;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductLikes;

class AccountController extends Controller
{
    public function login(){

        return view('fontend.account.login');
    }

    public function checkLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client// Tài khoản cấp độ khách hàng bình thường
        ];

        $remember = $request->remmeber;

        if (Auth::attempt($credentials,$remember)){

            return redirect()->intended('/home'); //Mặc định là trang chủ
        }else {
            return redirect()->back()->with('notification','ERROR: Email or password is wrong');
        }
    }

    public function logout(){
        Auth::logout();

        return back();

    }

    public function register(){

        return view('fontend.account.register');
    }

    public function forgotPassword(){
        return view('fontend.account.forgot-password');
    }

    public function checkUser(EmailRequest $request){
        $user = User::where('email',$request->input('email'))->first();

        if ($user == NULL){
            return redirect()->back()->with('notification','ERROR: Email is not exist!');
        }else {

            return redirect()->route('resetPassword',$user->id);
        }
    }

    public function resetPassword($id){

        $user = User::find($id);
        return view('fontend.account.reset-password',compact('user'));
    }

    public function checkReset(PasswordRequest $request,$id){
        if ($request->input('new_password') != $request->input('confirm_password')){
            return redirect()->back()->with('notification','ERROR: Confirm password does not match!');
        }else {
            $data = [
                'password' => bcrypt($request->input('new_password')),
            ];

            DB::table('users')->where('id',$id)->update($data);

            return redirect()->back()->with('success','Reset success! Please login!');
        }
    }

    public function postRegister(Request $request){
        if ($request->password != $request->password_confirmation){
            return back()->with('notification','ERROR: Confirm password does not match');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client //Đăng ký tài khoản cấp: tài khoản bình thường
        ];

        User::create($data);

        return redirect('/home/login')->with('notification','Register success! Please login');
    }

    public function myOrderIndex(){

        $orders = Order::where('user_id',Auth::id())->get();

        return view('fontend.account.my_order.index',compact('orders'));
    }

    public function myOrderShow($id){
        $order = Order::find($id);


        return view('fontend.account.my_order.show',compact('order'));
    }
}
