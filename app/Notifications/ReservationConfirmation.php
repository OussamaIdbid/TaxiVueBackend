<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class ReservationConfirmation extends Notification
{
    use Queueable;
    public $reservation;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation, $name)
    {
        $this->reservation = $reservation;
        $this->name = $name;

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
        $url = env('SANCTUM_STATEFUL_DOMAINS') . '/dashboard';
        return (new MailMessage)
                    ->subject('Reservering Bevestiging')
                    ->greeting("Hallo, " . $this->name . "!")
                    ->line("Ga naar je account overzicht om je reservering te bekijken")
                    ->action('Account Overzicht', $url)
                    ->salutation(" ");
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
