<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        //$resetUrl = url('/password/reset', ['token' => $this->token, 'email' => $notifiable->email]);

        return (new MailMessage)
            ->greeting('Hello, valued user!') // Custom greeting
            ->subject('Di LAS Reset Password Notification')
            ->line('Forgot your password? Click the reset link below.')
            ->action('Reset Password', $this->url)
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Best regards, Di LAS Team'); // Custom regards
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
