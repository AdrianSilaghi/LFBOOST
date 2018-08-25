<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
use Auth;

class EmailController extends Controller
{
    public function send(Request $request){
            $this->validate($request,[
                'issue' => 'required',
                'subject' => 'required',
                'message' =>'required'
            ]);

           $user = Auth::user();
           $message = $request->input('message'); 
           $issue = $request->input('issue');
           $subject = $request->input('subject');
        Mail::to('silaghi.adrian95@gmail.com')->send(new ContactForm($user,$issue,$subject,$message));

            return response(200);
    }

}
