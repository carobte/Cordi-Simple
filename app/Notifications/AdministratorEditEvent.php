<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdministratorEditEvent extends Notification
{
    use Queueable;

    protected $event;

    /**
     * Create a new notification instance.
     *
     * The constructor initializes the notification with the event data.
     *
     * @param  \App\Models\Event  $event  The event that has been cancelled.
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject(' El evento ha sido modificado')
        ->greeting('¡Hola!')
        ->line('Te informamos que el evento "' . $this->event->name . '" ha sido modificado.')
        ->line('Sabemos lo importante que es este evento para ti, y te pedimos disculpas por los inconvenientes que esta modificación te pueda ocasionar.')
        ->line('Si tienes preguntas o inquietudes, no dudes en contactarnos.')
        ->action('Ver detalles del evento', route('events.index'))
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
