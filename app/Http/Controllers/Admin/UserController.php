<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $users = User::paginate(3);
        $users = User::where('name','like','%' . $request->get('search') . '%' )
            ->orderBy('id','desc')
            ->paginate(5)
            ->appends(['search' => $request->get('search')]);

        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('password') != $request->get('password_confirmation')){
            return back()->with('notification','ERROR: Confirm password does not match');
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->get('password'));
        //Xử lí file
        if ($request->hasFile('image')){
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $file->getSize();

            $path = $file->move('public/fontend/img/user',$file->getClientOriginalName());
            $data['avatar'] = $fileName;
        }
        $user = User::create($data);


        return redirect('./admin/user/' . $user->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('backend.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->except(['_token','_method','image_old','password_confirmation','image']);

        //Xử lí mật khẩu
        if ($request->get('password') != NULL){
            if ($request->get('password') != $request->get('password_confirmation')){
                return back()->with('notification','ERROR!: Confirm password does not match');
            }

            $data['password'] = bcrypt($request->get('password'));

        }else {
            unset($data['password']);
        }

        //Xư lí file ảnh
        if ($request->hasFile('image')){
            //Thêm file mới
//            $data['avatar'] = Common::uploadFile($request->file('image'),'public/fontend/img/user');
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $file->getSize();

            $path = $file->move('public/fontend/img/user',$file->getClientOriginalName());
            $data['avatar'] = $fileName;

            //Xóa file cũ
            $file_name_old = $request->get('image_old');
            if ($file_name_old != ''){
                unlink('public/fontend/img/user/' . $file_name_old);
            }
        }
        //Cập nhật dữ liệu
        DB::table('users')
                ->where('id',$user->id)
                    ->update($data);


        return redirect('admin/user/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {


        //Xóa file ảnh

        $file_name = $user->avatar;
        if ($file_name != ''){
            unlink('public/fontend/img/user/' . $file_name);
        }

        DB::table('users')->where('id',$user->id)->delete();

        return redirect('admin/user');
    }
}
