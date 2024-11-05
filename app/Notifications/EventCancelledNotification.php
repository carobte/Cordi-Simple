<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventCancelledNotification extends Notification
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
    public function toMail($notifiable)
    {
        // Get the correct path to the logo image in the public folder
        $logoPath = public_path('imgs/logo.png'); // Using public_path() to get the correct path.

        // Check if the file exists before processing it
        if (file_exists($logoPath)) {
            // Encode the image as base64 if the file exists
            $logoBase64 = base64_encode(file_get_contents($logoPath));
            $logoDataUri = 'data:image/png;base64,' . $logoBase64;
        } else {
            // If the file is not found, set logoDataUri to null or use a default image URL
            $logoDataUri = null; // You can replace this with a default logo URL
        }

        // Create the email message
        return (new MailMessage)
            ->subject('¡Lo sentimos! El evento ha sido cancelado')
            ->greeting('¡Hola!')
            ->line('Lamentamos informarte que el evento "' . $this->event->name . '" ha sido cancelado.')
            ->line('Sabemos lo importante que es este evento para ti, y te pedimos disculpas por los inconvenientes que esto pueda causarte.')
            ->line('Si tienes preguntas o inquietudes, no dudes en contactarnos.')
            ->action('Ver detalles del evento', route('events.index'))
            ->salutation('¡Gracias por tu comprensión y apoyo!')

            // If the logo is available, we add it to the email
            ->with([
                'logo' => $logoDataUri // Send the logo as base64 (if available)
            ]);
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
