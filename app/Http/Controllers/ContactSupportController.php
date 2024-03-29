<?php

namespace App\Http\Controllers;

use App\ContactSupport;
use Illuminate\Http\Request;

class ContactSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getFirstQuestions(){
        
        $questions = ContactSupport::select('question')->where('firstquestion',true)->get();

        return response()->json($questions);
    }

    public function index()
    {
        //
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
     * @param  \App\ContactSupport  $contactSupport
     * @return \Illuminate\Http\Response
     */
    public function show(ContactSupport $contactSupport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactSupport  $contactSupport
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactSupport $contactSupport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactSupport  $contactSupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactSupport $contactSupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactSupport  $contactSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactSupport $contactSupport)
    {
        //
    }
}
