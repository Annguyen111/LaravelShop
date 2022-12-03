<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductLikes;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function index()
    {
        
        $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();
        return view('fontend.contact.index',compact('productlikes'));
    }



    public function submit(ContactRequest $request,$id){
        $data = [
            'user_id' => $id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('content')
        ];

        Contact::create($data);

        return redirect()->back()->with('notification','Contact success!');
    }


}
