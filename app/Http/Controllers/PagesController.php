<?php

namespace App\Http\Controllers;


use App\Post;
use App\User;
use Auth;
use App\Language;
use App\Game;
use App\Achivements;
use App\Country;
use Request;
use Location;
use \Torann\GeoIP\Facades\GeoIP;

class PagesController extends Controller
{
    public function getUserIp(){
        
        $ip = Request::ip();
        $position = geoip()->getLocation($ip);
        return view('getuserip')->with('ip',$ip)->with('position',$position);
    }

    public function commingOutSoon(){
        return view('outsoon');
    }
    public function index(){
        
        return view('welcome');
    }

    public function becomeSeller(){
        return view('become_a_seller');
    }

    public function dashboard(){
        $user = Auth::user();
        $lang = Language::all();
        $abilities = Game::all();
        $achiv = Achivements::all();
        $userLangTa = $user->lang;
        $userLang = $userLangTa->pluck('name');
        $userGames = $user->game;
        $userAchiv = $user->achivement;
        $countries = Country::all();
        return view('dashboard.orders')
        ->with('user',$user)
        ->with('language',$lang)
        ->with('game',$abilities)
        ->with('achivements',$achiv)
        ->with('userLang',$userLang)
        ->with('userLangTa',$userLangTa)
        ->with('userGames',$userGames)
        ->with('userAchiv',$userAchiv)
        ->with('countries',$countries);
    }
    public function settings(){
        return view('settings.settings');
    }
    public function account(){
        $user = Auth::user();
        $lang = Language::all();
        $abilities = Game::all();
        $achiv = Achivements::all();
        $userLangTa = $user->lang;
        $userLang = $userLangTa->pluck('name');
        $userGames = $user->game;
        $userAchiv = $user->achivement;
        $countries = Country::all();
        return view('settings.account')
        ->with('user',$user)
        ->with('language',$lang)
        ->with('game',$abilities)
        ->with('achivements',$achiv)
        ->with('userLang',$userLang)
        ->with('userLangTa',$userLangTa)
        ->with('userGames',$userGames)
        ->with('userAchiv',$userAchiv)
        ->with('countries',$countries);
        
    }

    public function earnings(){
        return view('dashboard.earnings');
    }

    public function privacy(){

        return view('privacy-policy');
    }

    public function contact(){
        return view('contact');
    }

    public function booster()
    {
        return view('howtofindabooster');
    }
    public function trustsafety(){
        return view('trustsafety');
    }
    public function tos(){

        return view('tos');
    }
    public function inbox(){

        return view('dashboard.inbox');
    }
    public function security(){
        $user = Auth::user();
        return view('settings.security')->with('user',$user);
    }

    public function payment(){
        $user = Auth::user();
        return view('settings.payment')->with('user',$user);
    }

    public function controlPanel(){
        if(auth()->user()->is_admin){
            return view('control.controlpanel');
        }else{
            return back()->with('warning','You are not an admin.');
        };
    }
    public function manageUsers(){
        if(auth()->user()->is_admin){
            return view('control.manageusers');
        }else{
            return back()->with('warning','You are not an admin.');
        };
    }
    public function manageOrders(){



        if(auth()->user()->is_admin){
            return view('control.manageorders');
        }else{
            return back()->with('warning','You are not an admin.');
        };
    }
    public function managePosts(){
        $posts = Post::withTrashed()->get();
        
        if(auth()->user()->is_admin){
            return view('control.manageposts')->with('posts',$posts);
        }else{
            return back()->with('warning','You are not an admin.');
        };
    }
}
