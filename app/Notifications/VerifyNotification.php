<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class VerifyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $params = [

            "id" => $notifiable->getKey(),
            "hash" => sha1($notifiable->getEmailForVerification()),
        ];

        $url = env('SANCTUM_STATEFUL_DOMAINS') . '/verify-email?';

        foreach ($params as $key => $param) {
            $url .= "{$key}={$param}&";
        }
        return (new MailMessage)
                    ->subject('Account Bevestiging')
                    ->greeting("Hallo!")
                    ->line('Email bevestiging voor account bij Taxi Lagelanden')
                    ->action('Bevestig email', $url)
                    ->salutation("Welkom bij Taxi Lagelanden!");
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
