<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Realm;
use App\Category;
use App\SubCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->paginate(10);
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        
        //create a new post
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();
        return redirect('/home/categories')->with('success','Category Created');
    }

    public function showSpecificCat($category){

        $cat = Category::where('name',$category)->first();
        $subcat = SubCategory::where('cat_id',$cat->id)->get();
        return view('categories.index')->with('categories',$cat)->with('subcat',$subcat);
    }

    public function showPostByCat($category,$subcategory){
       
  
        $posts = Post::where('subcat_name',$subcategory)->where('cat_name',$category)->paginate(20);
        $subcat = SubCategory::where('name',$subcategory)->first();
        return view('posts.index')->with('posts',$posts)->with('subcat',$subcat)->with('categories',$category);
        

   }
    
   public function showPostByPrice($category,$subcategory){

        $subcat = SubCategory::where('name',$subcategory)->first();
        $posts = Post::where('subcat_name',$subcategory)->where('cat_name',$category)->orderBy('price','desc')->paginate(20);
        return view('posts.index')->with('posts',$posts)->with('categories',$category)->with('subcat',$subcat);
   }

   public function showPostByViews($category,$subcategory){

    $subcat = SubCategory::where('name',$subcategory)->first();
    $posts = Post::where('subcat_name',$subcategory)->where('cat_name',$category)->orderByViewsCount()->paginate(20);
    return view('posts.index')->with('posts',$posts)->with('categories',$category)->with('subcat',$subcat);
    }

    public function showPostsByDate($category,$subcategory){

        $subcat = SubCategory::where('name',$subcategory)->first();
        $posts = Post::where('subcat_name',$subcategory)->where('cat_name',$category)->orderBy('created_at','desc')->paginate(20);
        return view('posts.index')->with('posts',$posts)->with('categories',$category)->with('subcat',$subcat);
        }
}
