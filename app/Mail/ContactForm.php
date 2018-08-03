<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $message;
    public $subject;
    public $issue;

    public function __construct(User $user,$issue,$subject,$message)
    {
        $this->user = $user;
        $this->message = $message;
        $this->issue = $issue;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        return $this->markdown('contactemailsent')
                    ->subject($this->subject)
                    ->with([
                        'issue'=>$this->issue,
                        'username' => $this->user->name,
                        'email' => $this->user->email,
                        'message' => $this->message,
                    ]);
    }
}
