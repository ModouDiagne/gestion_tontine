<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ParticipantNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Créer une nouvelle notification.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Définir les canaux de notification (email).
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Construire l'email de notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification de Tontine')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line($this->message)
            ->action('Voir plus', url('/'))
            ->line('Merci de faire partie de notre tontine !');
    }
}
