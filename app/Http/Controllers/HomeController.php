<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Realm;
use App\SubCategory;
use Auth;
use App\Achivements;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('verified',true)->orderBy('created_at','desc')->take(12)->get();
        $popular = Post::where('verified',true)->orderByViewsCount()->take(12)->get();
        
        return view('home')->with('posts',$posts)->with('popular',$popular);
    }
    public function create()
    {
        $user = Auth::user();
        $userLevel = $user->level;
        $numberOfPosts = count($user->posts);




        $category = Category::all();
        $realm = Realm::all();
        $post = Post::all();
        $subcat = SubCategory::all();
        
        if(auth()->user()->level == 0){
            if($numberOfPosts >= 5 ){
                return back()->with('warning','You can only create 5 posts.');
            }else{
                return view('posts.testcreat')->with('categories',$category)->with('realms',$realm)->with('subCat',$subcat);
            };
        };

        if(auth()->user()->level == 1){
            if($numberOfPosts >= 7 ){
                return back()->with('warning','You can only create 7 posts.');
            }else{
                return view('posts.testcreat')->with('categories',$category)->with('realms',$realm)->with('subCat',$subcat);
            }
        }

        if(auth()->user()->level == 2){
            if($numberOfPosts >= 10 ){
                return back()->with('warning','You can only create 10 posts.');
            }else{
                return view('posts.testcreat')->with('categories',$category)->with('realms',$realm)->with('subCat',$subcat);
            }
        }
        
        if(auth()->user()->level == 3){
            if($numberOfPosts >= 15 ){
                return back()->with('warning','You can only create 15 posts.');
            }else{
                return view('posts.testcreat')->with('categories',$category)->with('realms',$realm)->with('subCat',$subcat);
            }
        }
    }

    public function posts()
    {
        $category = Category::all();
        $realm = Realm::all();
        $post = Post::with('category','realm')->get();
        return view('dashboard.posts')->with('categories',$category)->with('realms',$realm)->with('post',$post);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::all();
        $realm = Realm::all();
        return view('dashboard.edit')->with('categories',$category)->with('realms',$realm)->with('post',$post);
    }

    public function findCatName(Request $request){

        $data = SubCategory::select('name','id')->where('cat_id',$request->id)->take(100)->get();
        
        return response()->json($data);
        

    }

    public function findLanguage(Request $request){
        
        $data = Auth::user()->lang;
        return response()->json($data);
    }

    public function findAchivName(Request $request){

        $data = Achivements::select('name','id')->where('game_id',$request->id)->take(100)->get();

        return response()->json($data);

    }

    public function findPostByNmae(Request $request){
        

        $data = Post::select('id','slug')->where('title',$request->title)->first();

        return response()->json($data);

    }

    public function showReviewPost(Request $request){
        
        $post = Post::where('id',$request->id)->first();

        return view('control.specificPost')->with('post',$post);

    }
}
