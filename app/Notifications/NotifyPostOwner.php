<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;




class NotifyPostOwner extends Notification
{
    use Queueable;

    public $post;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post,$message)
    {
        $this->post = $post;
        $this->message = $message;
    }


    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'post' => $this->post,
            'message' => $this->message,
        ];
    }
    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'post' => $this->post,
                'msg' => $this->message,
            ]
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

