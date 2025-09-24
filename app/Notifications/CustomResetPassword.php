<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;
    public $token , $guard;
    /**
     * Create a new notification instance.
     */
    public function __construct($token , $guard)
    {
        $this->token = $token ;
        $this->guard = $guard ;
    }

 
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
                'guard' => $this->guard , 
            ], false));

        return (new MailMessage)
                ->subject('🔑 إعادة تعيين كلمة المرور لحسابك في Vapping')
                ->view('dashboard.mails.reset-password-layout', [
                    'user' => $notifiable,
                    'url' => $url,
                ]);
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
