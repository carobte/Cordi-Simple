<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReserveCancelledNotification extends Notification{
   
    use Queueable;
   
    protected $reserve;

    public function __construct($reserve){
        $this->reserve = $reserve;
    }

    public function toMail($notifiable){
       
        return (new MailMessage)
        ->subject('¡Lo sentimos! Tu reserva ha sido cancelada')
        ->greeting('¡Hola '. $this->reserve->user->name . "!")
        ->line('Lamentamos informarte que tu reserva para el evento "' . $this->reserve->event->name . '" ha sido cancelada.')
        ->line('Sabemos lo importante que es este evento para ti, y te pedimos disculpas por los inconvenientes que esto pueda causarte.')
        ->line('Si tienes preguntas o inquietudes, no dudes en contactarnos.')
        ->salutation('¡Gracias por tu comprensión!');
    }

    public function via($notifiable)
    {
        return ['mail']; // Send via email
    }
}