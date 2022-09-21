<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessRegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($teacher)
    {
        //
        $this->teacher=$teacher;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // via is the channel we send the notification to 
        return ['mail']; //'slack
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) //toSlack
    {
        // can also cuztomize mail template 
        return (new MailMessage)->view('page.orignal_welcome');
        
        // return (new MailMessage)
        //             //title of email
        //             ->subject('Congrats '.$this->teacher->name)
        //                 //the text message
        //             ->line('You are succesfully registered.')
                    
        //             //button with the text + link
        //             ->action('Login Now ', url('/'))

        //             //another text message after the button 
        //             ->line('Byeeeeee!');
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
