<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCancelledReservation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's mail representation.
     *
     * This method builds the email that will be sent to the notifiable user.
     * It includes the event name, a cancellation message, and an optional logo (encoded in base64).
     *
     * @param  mixed  $notifiable  The user or model that is being notified.
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        // Create the email message
        return (new MailMessage)
            ->subject('Reserva cancelada con éxito')
            ->greeting('¡Hola!')
            ->line('Te informamos que la reserva "' . $this->reservation->event->name . '" ha sido cancelada.')
            ->line('Lamentamos que hayas tenido que cancelar tu reserva, te esperamos en un próximo evento')
            ->line('Nuestros canales de comunicación están abiertos para tu comodidad.')
            ->action('Ver detalles de la  reserva', route('reservations.index'))
            ->salutation('¡Gracias por tu comprensión y apoyo!');



    }

    /**
     * Get the channels the notification should be sent on.
     *
     * This method defines which notification channels should be used to send the notification.
     * In this case, the notification is sent via email.
     *
     * @param  mixed  $notifiable  The user or model that is being notified.
     * @return array  List of channels to send the notification.
     */
    public function via($notifiable)
    {
        return ['mail']; // Send via email
    }
}
