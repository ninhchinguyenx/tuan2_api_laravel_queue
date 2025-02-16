<?php

namespace App\Listeners;

use App\Events\RegisterSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterSuccessNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterSuccess $event)
    {
        $user = $event->user; 

        $data = [
            'name' => $user->name,
            'email' => $user->email
        ];
            Mail::send('mail', $data ,function(Message $message){
                $message->from('ninh4513@gmail.com');
                $message->to('ninh4513@gmail.com');
                $message->subject('Thông báo tạo người dùng thành công');
        });
    }
}
