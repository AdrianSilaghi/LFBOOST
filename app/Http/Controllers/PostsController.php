<?php

namespace App\Http\Controllers;

use App\Notifications\NotifyPostOwner;
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
use SEO;
use Auth;
use Session; 
use Illuminate\Support\Facades\URL;
use App\RecentlyViewed;
use App\Rules\TitleValidation;


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


    public function index(Request $request)
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

        $this->defaultCatPic($post->id);

        $post->attachTags($tags);
        if(is_array($questions)){
        for($i=0;$i<count($questions);$i++){
            $quest = new Question;
            $quest->question = $questions[$i];
            $quest->answer =$answers[$i];
            $quest->save();

            $post->question()->attach($quest);
        }
    }

       
       
        $request->session()->flash('success','Your boost has been posted!');
        
    
    }

    public function defaultCatPic($postId)
    {
        $post = Post::find($postId);
        if ($post->category_id == 1) {
            $post->image = 'lol.png';
            $post->save();
        }
        if ($post->category_id == 2) {
            $post->image = 'wow.png';
            $post->save();
        }
        if ($post->category_id == 3) {
            $post->image = 'fortnite.png';
            $post->save();
        }
        if ($post->category_id == 4) {
            $post->image = 'overwatch.png';
            $post->save();
        }
        if ($post->category_id == 5) {
            $post->image = 'csgo.png';
            $post->save();
        }
        if ($post->category_id == 6) {
            $post->image = 'pubg.png';
            $post->save();
        }
        if ($post->category_id == 7) {
            $post->image = 'dota.png';
            $post->save();
        }
        if ($post->category_id == 8)
        {
            $post->image = 'hs.png';
            $post->save();
        }
        if($post->category_id == 9)
        {
            $post->image = 'rb6s.png';
            $post->save();
        }

    }

    public function detachQuestions(Request $request){
        $question = Question::find($request->qa);
        $post = Post::find($request->postId);

        $post->question()->detach($question);
        
        return back();
    }

    public function validatePostDescription(Request $request){
        $this->validate($request,[
            'post_description'=>'min:120|max:1200'
        ]);
        return response(200);
    }

    public function validatePriceDescription(Request $request){
        
        $this->validate($request,[
            'price_description'=>'min:20|max:120'
        ]);

        return response(200);
    }
    public function validatePost(Request $request){
         
        $this->validate($request,[
            'title'=>['required', new TitleValidation],
            'categories'=>'required',
            'subcategories' => 'required',
            'price'=>'required|min:5|max:995|integer|',
            'delivery_time'=>'required|max:30|integer',
            'requirements'=>'required|min:10|regex:/^[a-zA-Z\s\w\#!.,?\-\']*$/i',
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
            Image::make($image)->save( public_path('/uploads/posts/' .'big'.$filename));    
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

    public function showWithName(Request $request,$user,$slug){
        $post = Post::where('slug',$slug)->first();
        $users = User::where('name',$user)->first();
        $qPost = $post->question;
        $tags = $post->tags()->get();
        $reviews = $post->review;
        
        SEO::setTitle($post->title);
        SEO::setDescription($post->body);

        
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

        if($post->verified == 1)
        {
            $recentlyViewed = new RecentlyViewed;
            $recentlyViewed->user_id  = Auth::user()->id;
            $recentlyViewed->post_id = $post->id;
            $recentlyViewed->save();
        }

        return view('posts.show')->with('post',$post)
                                 ->with('user',$users)
                                 ->with('qa',$qPost)
                                 ->with('tags',$tags)
                                 ->with('raiting',$avg)
                                 ->with('countReviews',$countReviews)
                                 ->with('reviews',$reviews)
                                 ->with('request',$request);
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
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();

        $recentlyViewed = RecentlyViewed::where('post_id',$request->id)->get();
        foreach($recentlyViewed as $rc){
            $rc->delete();
        }

        $url = URL::route('myBoosts') . '#removedBoost';
        return redirect($url);
    }

    public function myBoosts(){
        $user = Auth::user(); 

        $posts = Post::where('user_id',$user->id)->get();
        return view('dashboard.boosts')->with('posts',$posts);
    }

    public function editPost(Request $request){
        
        $category = Category::all();
        $subcat = SubCategory::all();
       
        $post = Post::where('id',$request->id)->where('user_id',auth()->user()->id)->first();
        $qPost = $post->question;
        return view('dashboard.editpost')->with('post',$post)->with('categories',$category)->with('subCat',$subcat)->with('qa',$qPost);
    }


    public function updateBoost(Request $request){
        
        
        $cat_id = $request->input('categories');
        $subCat_id= $request->input('subcategories');
        
        //create a new post
        $post = Post::find($request->input('postId'));
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('categories');
        $post->subcat_id = $request->input('subcategories');
        $post->cat_name = Category::where('id',$cat_id)->value('name');
        $post->subcat_name = SubCategory::where('id',$subCat_id)->value('name');
        $post->price = $request->input('price');
        $post->price_description = $request->input('price_description');
        $post->delivery_time = $request->input('delivery_time');
        $post->requirements = $request->input('requirements');

        $questions = $request->input('question');
        $answers = $request->input('answer');

        $tags = $request->input('tags');

        $post->verified = 0;
        $post->denied = 0;

        $post->save();


        $post->attachTags($tags);
        if(is_array($questions)){
            for($i=0;$i<count($questions);$i++){
                $quest = new Question;
                $quest->question = $questions[$i];
                $quest->answer =$answers[$i];
                $quest->save();
    
                $post->question()->attach($quest);
            }
        };

        return response(200);
    }
    public function verifyPost(Request $request)
    {
        $user = User::find($request->user_id);
        $post = Post::find($request->post_id);
        $post->verified = 1;
        $post->denied = 0;
        $post->modification = $request->modification;
        $post->save();

        $user->notify(new NotifyPostOwner($post,'Your post has been verified!'));
        return response()->json('200','200');
    }
    public function  denyPost(Request $request)
    {
        $user = User::find($request->user_id);
        $post = Post::find($request->post_id);
        $post->verified = 0;
        $post->denied = 1;
        $post->modification = $request->modification;
        $post->save();

        $user->notify(new NotifyPostOwner($post,'Your post has been denied , add the required modifications!'));
        return response()->json('200','200');
    }
}