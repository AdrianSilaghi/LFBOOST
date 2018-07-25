<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Review;
use App\Post;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'comment'=>'required|min:5|max:55|regex:/^[a-zA-Z\s]*$/',
            'raiting'=>'required|max:5'
        ]);

        $review = new Review;
        $review->comment = $request->input('comment');
        $review->raiting = $request->input('raiting');
        $review->user_id = auth()->user()->id;
        $review->save();

        $post = Post::where('id',$request->input('post_id'))->first();

        $post->review()->attach($review);

        return back();
    }

   
}
