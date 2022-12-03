<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductLikes;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $blogs = Blog::paginate(3);
        $blogs = DB::table('blogs')
            ->where('category','like','%' . $request->get('search') . '%' )
            ->orderBy('id','asc')
            ->paginate(3)
            ->appends(['search' => $request->get('search')]);

            if (isset(Auth::user()->id)){
                $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();
                return view('fontend.blog.index',compact('blogs','productlikes'));

            }

        return view('fontend.blog.index',compact('blogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $previousBlog = Blog::find($id - 1);
        $blog = Blog::find($id);
        $nextBlog = Blog::find($id + 1);

        $blogComment = BlogComment::find($blog->id);


        return view('fontend.blog.show',compact('blog','previousBlog','nextBlog','blogComment'));
    }

    public function postComment(Request $request){
        $data = $request->except(['message']);

        BlogComment::create($data);


        return redirect()->back();
    }


}
