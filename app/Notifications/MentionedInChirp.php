<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MentionedInChirp extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Chirp $chirp,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('You were mentioned in a Chirp'))
            ->line(__('You were mentioned in a chirp:'))
            ->line('"' . e($this->chirp->content?->toPlainText()) . '"')
            ->action('View Chirp', url('/'))
            ->line('Thank you for using Chirper!');
    }
}
