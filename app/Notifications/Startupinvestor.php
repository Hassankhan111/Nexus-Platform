<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Startupinvestor extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $sender;
    public $message;
    public $imgpath;
    public function __construct($sender,$message,$imgpath = null)
    {
        $this->sender = $sender;
        $this->message = $message;
        $this->imgpath = $imgpath;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    /*public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }*/

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'role' => $this->sender->role,
            'message' => $this->message,
            'image' => $this->imgpath,
        ];
    }
}
