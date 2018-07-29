<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Auth::user()->contacts();
 
        return view('dashboard.inbox')->withContacts($contacts);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $contact = User::find($id);

        return view('dashboard.show')->withContact($contact);
    }

    public function getChat($id){
        $chats = Chat::where(function ($query) use ($id){
            $query->where('user_id' , '=', Auth::user()->id)->where('contact_id','=',$id);
        })->orWhere(function($query) use ($id){
            $query->where('user_id','=',$id)->where('contact_id','=', Auth::user()->id);
        })->get();

        return $chats;
    }

    public function sendChat(Request $request){
        Chat::create([
            'user_id' => $request->user_id,
            'contact_id'=> $request->contact_id,
            'chat'=> $request->chat
        ]);

        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
