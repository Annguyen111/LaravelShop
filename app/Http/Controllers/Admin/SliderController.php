<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $sliders = Slider::all();
        $sliders = Slider::where('title','like','%' . $request->get('search') . '%' )
        ->orWhere('sale','=' , $request->get('search') )
        ->orWhere('tag','like','%' . $request->get('search') . '%' )
            ->orderBy('id','asc')
            ->paginate(5)
            ->appends(['search' => $request->get('search')]);

        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
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

            $path = $file->move('public/fontend/img/slider',$file->getClientOriginalName());
            $data['image'] = $fileName;
        }
        $slider = Slider::create($data);


        return redirect('./admin/slider/' . $slider->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.edit', compact('slider'));
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

            $path = $file->move('public/fontend/img/slider',$file->getClientOriginalName());
            $data['image'] = $fileName;


            //Xóa file cũ
            $file_name_old = $request->get('image_old');
            if ($file_name_old != ''){
                unlink('public/fontend/img/slider/' . $file_name_old);
            }
        }
        //Cập nhật dữ liệu
        DB::table('slider')
            ->where('id',$id)
            ->update($data);

        return redirect('admin/slider/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file_name = Slider::where('id',$id)->first();
        if ($file_name->image != ''){
            unlink('public/fontend/img/slider/' . $file_name->image);
        }
        
        DB::table('slider')
            ->where('id',$id)
            ->delete();

        return redirect('admin/slider');
    }
}
