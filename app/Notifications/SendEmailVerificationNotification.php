<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class SendEmailVerificationNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */


    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $user_type = $notifiable->user_type->value ?? $notifiable->user_type;

        $message = new MailMessage();

        $message->subject('Welcome! Please verify your email address for Purple Pages')
            ->greeting('Hello ' . Str::ucfirst($notifiable->first_name));


        $message->line('Welcome to Purple Pages. We are really happy that you want to join us in making the world a more accessible place for everyone.')
            ->line('To help us keep the platform safe please verify the email address, by clicking the link below.')
            ->action('Verify Email', $this->verificationUrl($notifiable))
            ->line('If you did not request access to the platform then please ignore this email.')
            ->line('We hope that you find the platform easy to use, but please feel free to contact us with any questions, suggestions for improvement.');

        $message->salutation(new HtmlString("Regards,<br>Louise and the Purple Pages Team"));

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
