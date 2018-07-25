<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;
use Carbon\Carbon;

class PrivateMessage extends Model
{
    protected $fillable  =[
        'sender_id','receiver_id','subject','message','read'

    ];

    protected $appends =['sender','reciver'];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }

    public function getSenderAttribute(){
        return User::where('id',$this->sender_id)->first();
    }
    public function getReciverAttribute(){
        return User::where('id',$this->receiver_id)->first();
    }
}
