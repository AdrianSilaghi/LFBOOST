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

    public function store (Request $request){
        $cotnact = new Contacts;
        $contact->user_id = Auth::user()->id;
        $contact->contact_id= $request->contact_id;
        $contact->save();


    }

    public function getContacts(){

        $contacts = Auth::user()->contacts();
 
        return view('dashboard.inbox')->withContacts($contacts);
    }

    public function getContactsName(Request $request){

    }
}
