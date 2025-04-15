<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionTable extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to the App!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have successfully registered.')
            ->action('Visit Dashboard', url('/dashboard'))
            ->line('Thank you for joining us!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Welcome, ' . $notifiable->name . '! You have successfully registered.',
            'url' => url('/dashboard'),
        ];
    }
}