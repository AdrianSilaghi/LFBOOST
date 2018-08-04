<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Language;
use App\Game;
use App\Achivements;
use Image;
use Auth;
use \Spatie\Tags\HasTags;
use \Spatie\Tags\Tag;
use App\Rules\UniquePayPal;

class UsersController extends Controller
{
    use \Spatie\Tags\HasTags;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('user',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug',$slug)->first();
        $language = Language::all();
        $abilities = Game::all();
        $achivements = Achivements::all();
        $userLang = $user->lang; 
        $userGames = $user->game;
        $userAchiv = $user->achivement;
        return view('users.show')
        ->with('user',$user)
        ->with('language',$language)
        ->with('game',$abilities)
        ->with('achivements',$achivements)
        ->with('userLang',$userLang)
        ->with('userGames',$userGames)
        ->with('userAchiv',$userAchiv);
    }

    
    public function validateForm(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255|unique:users|regex:/^[a-zA-Z0-9\s]*$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);

        return response(200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user',$user);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updatePaypalEmail(Request $request){
        $this->validate($request,[
            'email'=>['required',new UniquePayPal]
        ]);

        $user = Auth::user();
        $user->paypal_email = $request->input('email');
        $user->save();
        $request->session()->flash('success','Your PayPal E-mail has been updated');    
        return back();
    }

    public function update(Request $request, $id)
    {   
      
        $this->validate($request,[
            'description' => 'min:20|max:255',
            'sdescription' => 'min:3|max:40'
        ]);
        
        //create a new post
        $user = User::find($id);
        $user->short_description = $request->input('sdescription');
        $user->description = $request->input('description'); 
        $user->country = $request->input('country');
        $user->save();
        
        
        $user->lang()->attach($request->input('language'),['level'=>$request->input('level')]);
        $request->session()->flash('success','Your profile has been updated');
        return back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update_avatar(Request $request){

            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename));

                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }

            return back();
    }

    public function detachLang(Request $request){

        $user = Auth::user();
        $user->lang()->detach($request->input('id'));
        
    }

    public function addNewLanguage(Request $request){

        $user = Auth::user();
        $user->lang()->attach($request->input('language'),['level'=>$request->input('level')]);

        
    }

    public function detachGame(Request $request){

        $user = Auth::user();
        $user->game()->detach($request->input('id'));
        
    }

    public function addNewGame(Request $request){

        $user = Auth::user();
        $user->game()->attach($request->input('game'));  
    }

    public function detachAchivement(Request $request){
        $user = Auth::user();
        $user->achivement()->detach($request->input('id'));
    }

    public function addNewAchivement(Request $request){
        
        $gameName = $request->input('game');

        $game_name = Game::find($gameName)->name;
        
        $user = Auth::user();
        $user->achivement()->attach($request->input('achivements'),['game_name'=>$game_name]);  
    }
}
