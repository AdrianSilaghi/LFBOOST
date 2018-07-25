<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UpdateEmailController extends Controller
{
    
    public function _construct(){
        $this->middleware('auth');
    }

    public function update(Request $request){

        $this->validate($request,[
            'email'=>'required'
        ]);
        
        $user = Auth::user();

        $user->fill([
            'email' => $request->email
        ])->save();

        $request->session()->flash('success','Your email has been updated');
            
        return back();

    }
}
