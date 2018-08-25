<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }    

    public function index(){
        return view('settings.security');
    }

    public function update(Request $request){
        
        $this->validate($request,[
            'old'=>'required',
            'password'=>'required|min:6|confirmed',
        ]);
        $user = Auth::user();
        $hashedPassword = $user->password;

        if (Hash::check($request->old,$hashedPassword)){
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $request->session()->flash('success','Your password has been updated');
            
            return back();
        }

        $request->session()->flash('failure','Your password has not been updated');

        return back();
    }
}
