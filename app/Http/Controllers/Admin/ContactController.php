<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request){
        $contacts = Contact::where('name','like','%' . $request->get('search') . '%' )
            ->orderBy('id','desc')
            ->paginate(5)
            ->appends(['search' => $request->get('search')]);

        return view('backend.contact.index',compact('contacts'));
    }

    public function destroy($id){
        DB::table('contacts')->where('id',$id)->delete();

        return redirect()->back();
    }

    public function show($id){
        $contact = Contact::find($id);
        return view('backend.contact.show',compact('contact'));
    }

    public function replyMessage(Request $request,$id){
        $contact = Contact::find($id);
        $messages = $request->input('reply');
        $this->sendEmail($contact,$messages);


        return redirect()->back()->with('notification','Send message success!');
    }

    private function sendEmail($contact,$messages){
        $email_to = $contact->email;
        Mail::send('backend.contact.mail.email',compact('contact','messages'), function($message) use ($email_to) {
            $message->from('annq7923@gmail.com','Fashi Shop');
            $message->to($email_to,$email_to);
            $message->subject('Reply Contact');
        });
    }
}
