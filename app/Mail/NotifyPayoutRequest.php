<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyPayoutRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $ammount;

    public function __construct($user,$ammount)
    {
        $this->user = $user;
        $this->ammount = $ammount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('notifypayoutrequest')
            ->subject('Payout Request IMPORTANT')
            ->to('silaghi.adrian95@gmail.com')
            ->with([
                'user'=>$this->user,
                'ammount'=>$this->ammount,
            ]);
    }
}
