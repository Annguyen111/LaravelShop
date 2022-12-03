<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Utilities\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = DB::table('blogs')
            ->where('title','like','%' . $request->get('search') . '%' )
            ->orderBy('id','asc')
            ->paginate(5)
            ->appends(['search' => $request->get('search')]);

        return view('backend.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
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

        //Xử lí file
        if ($request->hasFile('image')){
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $file->getSize();

            $path = $file->move('public/fontend/img/blog',$file->getClientOriginalName());
            $data['image'] = $fileName;
        }
        $blog = Blog::create($data);


        return redirect('./admin/blog/' . $blog->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('backend.blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);


        return view('backend.blog.edit',compact('blog'));
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
        $data = $request->except(['_token','_method','image_old']);

        //Xư lí file ảnh
        if ($request->hasFile('image')){
            //Thêm file mới
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $file->getSize();

            $path = $file->move('public/fontend/img/blog',$file->getClientOriginalName());
            $data['image'] = $fileName;


            //Xóa file cũ
            $file_name_old = $request->get('image_old');
            if ($file_name_old != ''){
                unlink('public/fontend/img/blog/' . $file_name_old);
            }
        }
        //Cập nhật dữ liệu
        DB::table('blogs')
            ->where('id',$id)
            ->update($data);

        return redirect('admin/blog/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file_name = Blog::where('id',$id)->get();
        if ($file_name->image != ''){
            unlink('public/fontend/img/blog/' . $file_name);
        }

        DB::table('blog_comments')
            ->where('blog_id',$id)
            ->delete();


        DB::table('blogs')
            ->where('id',$id)
            ->delete();

        return redirect('admin/blog');
    }
}
