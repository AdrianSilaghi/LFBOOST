<?php

namespace App\Http\Controllers;

use App\Broadcasting;
use Illuminate\Http\Request;
use Auth;
use App\Events\MessageSentEvent;
use Broadcast;
use App\Message;

class MessageController extends Controller
{
    public function _construct(){
        $this->middleware('auth');

    }
    
    public function fetch(){
        return Message::with('user')->get();
    }

    public function sentMessage(Request $request){
        $user = Auth::user();
            $message = $user->messages()->create([
            'message'=> request()->message,
            'conversation_id'=> request()->conversation_id,
        ]);
        
        broadcast(new MessageSentEvent($user,$message))->toOthers();
        // broadcast(new MessageSentEvent($user,$message));

    }
}
