<?php

namespace App\Http\Controllers;

use CyrildeWit\EloquentViewable\Viewable;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Realm;
use \Spatie\Tags\HasTags;
use App\SubCategory;
use Image;
use App\Question;
use \Spatie\Tags\Tag;
use App\User;

class PostsController extends Controller
{
    use Viewable;
    use \Spatie\Tags\HasTags;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index()
    {
        $post = Post::paginate(20);
        $category = Category::all();
        $realm = Realm::all();
        $subcat = SubCategory::all();
        return view('posts.index')->with('categories',$category)->with('realms',$realm)->with('posts',$post)->with('subCat',$subcat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $realm = Realm::all();
        return view('posts.create')->with('categories',$category)->with('realms',$realm);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        

        $cat_id = $request->input('categories');
        $subCat_id= $request->input('subcategories');
        
        //create a new post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('categories');
        $post->subcat_id = $request->input('subcategories');
        $post->cat_name = Category::where('id',$cat_id)->value('name');
        $post->subcat_name = SubCategory::where('id',$subCat_id)->value('name');
        $post->user_id = auth()->user()->id;
        $post->price = $request->input('price');
        $post->price_description = $request->input('price_description');
        $post->delivery_time = $request->input('delivery_time');
        $post->requirements = $request->input('requirements');
        $post->username = auth()->user()->slug;

        $questions = $request->input('question');
        $answers = $request->input('answer');

        $tags = $request->input('tags');

        $post->save();


        $post->attachTags($tags);

        for($i=0;$i<count($questions);$i++){
            $quest = new Question;
            $quest->question = $questions[$i];
            $quest->answer =$answers[$i];
            $quest->save();

            $post->question()->attach($quest);
        }
        

       
       
        $request->session()->flash('success','Your boost has been posted!');
        
    
    }

    public function validatePost(Request $request){
         
        $this->validate($request,[
            'title'=>'required|min:15|max:55|regex:/^[a-zA-Z\s]*$/',
            'categories'=>'required',
            'subcategories' => 'required',
            'price_description'=>'required|min:20|max:120|regex:/^[a-zA-Z\s\w\#!.?-]*$/i',
            'price'=>'required|min:5|max:995|integer|',
            'delivery_time'=>'required|min:5|max:30|integer',
            'body'=>'required|min:120|max:1200|regex:/^[a-zA-Z\s\w\#!.?-]*$/i',
            'requirements'=>'required|min:10|regex:/^[a-zA-Z\s\w\#!.?-]*$/i',
        ]);
    }

    public function getPostId(Request $request){
        $data = Post::where('id',$user_id)->orderBy('id','desc')->first();
        return response()->json($data);
    }

    public function addImage(Request $request){
       
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(286,180)->save( public_path('/uploads/posts/' . $filename));

        $post = Post::find($request->id);
        $post->image = $filename;
        $post->save();  
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();

        $post->addView();

        return view('posts.show')->with('post',$post);  
    }

    public function showWithName($user,$slug){
        $post = Post::where('slug',$slug)->first();
        $users = User::where('name',$user)->first();
        $qPost = $post->question;
        $tags = $post->tags()->get();
        $reviews = $post->review;
        
        if(count($reviews)==0){
            $avg = 0;
            $countReviews = 0;
        }else{

        
        foreach($reviews as $r){
            

                $a[] = $r->raiting;

            
            }

            $avg = round(array_sum($a)/count($a),1);
            $countReviews = count($a);
        }
        $post->addView();
        return view('posts.show')->with('post',$post)->with('user',$users)->with('qa',$qPost)->with('tags',$tags)->with('raiting',$avg)->with('countReviews',$countReviews);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function addedNewBosot(Request $request){
        $request->session()->flash('success','Your profile has been updated');
        return view('posts.index');
     }
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Wrong Page');
        }
        return view('dashboard.edit')->with('post',$post);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'categories'=>'required',
            'realm'=>'required'
        ]);
        
        //create a new post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('categories');
        $post->realm_id = $request->input('realm');
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success','Post Removed');
    }


}