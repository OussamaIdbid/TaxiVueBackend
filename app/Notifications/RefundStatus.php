<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefundStatus extends Notification
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
        $refundString = "";
        $refundString2 = "";
        $url = env('SANCTUM_STATEFUL_DOMAINS') . '/dashboard';

        if ($this->reservation->refundIsAsked && $this->reservation->refundIsDenied) {
            $refundString = "Je terugbetalingverzoek met ordernummer #" . $this->reservation->order_id . " is helaas geweigerd";
        } elseif ($this->reservation->refundIsAsked && $this->reservation->refundIsConfirmed) {
            $refundString = "Je terugbetalingverzoek met ordernummer #" . $this->reservation->order_id . " is geaccepteerd!";
            $refundString2 = "Je krijgt zo snel mogelijk je geld teruggestort.";

        } else {
            $refundString = "Je terugbetalingverzoek met ordernummer #" . $this->reservation->order_id ." is in behandeling";
            $refundString2 = "We gaan er zo snel mogelijk mee aan de slag!";

        }
        return (new MailMessage)
            ->subject('Terugbetaling')
            ->greeting("Hallo, " . $this->name . "!")
            ->line($refundString)
            ->line($refundString2)
            ->line("Ga naar je account overzicht om je terugbetalingverzoek te bekijken")
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
