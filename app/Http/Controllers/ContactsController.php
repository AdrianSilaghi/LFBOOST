<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Contacts;

class ContactsController extends Controller
{
    

    public function _construct(){
        $this->middleware('auth');
    }

    public function store ($user_id,$contact_id){



        $contact = new Contacts;
        $contact->user_id = $user_id;
        $contact->contact_id= $contact_id;
        $contact->save();

        session()->flash('success','Your payment was successful , order and a new conversation were created!');
        return response(200);
    }

    public function checkIfContacts ($user_id,$contact_id){

        $contact = Contacts::where(function ($query) use ($user_id,$contact_id){
            $query->where('user_id' , '=', $user_id)->where('contact_id','=',$contact_id);
        })->orWhere(function($query) use ($user_id,$contact_id) {
            $query->where('user_id','=',$contact_id)->where('contact_id','=', $user_id);
        })->get();

        if(count($contact)){
            return 1;
        }else{
            return 2;
        }



    }

    public function getContacts(){

        $contacts = Auth::user()->contacts();
 
        return view('dashboard.inbox')->withContacts($contacts);
    }

    public function getContactsName(Request $request){

    }
}
