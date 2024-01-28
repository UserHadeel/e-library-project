<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class create_loan extends Notification
{
    use Queueable;


    private $user_create;
    public function __construct($user_create)
    {
        $this->user_create =$user_create;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
           'user_create'=>$this->user_create
        ];
    }
}
