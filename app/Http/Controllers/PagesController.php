<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use App\Language;
use App\Game;
use App\Achivements;
use App\Country;


class PagesController extends Controller
{
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
        return view('dashboard.orders');
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

    public function inbox(){

        return view('dashboad.inbox');
    }
    public function security(){
        $user = Auth::user();
        return view('settings.security')->with('user',$user);
    }
}
