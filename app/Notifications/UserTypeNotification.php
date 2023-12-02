<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Auth;

class UserTypeNotification extends Notification
{
    use Queueable;
    protected $user;
    /**
     * @var \App\Models\User
     *
     */
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('user Manager')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('Congratulations, you have become the users manager.')
                    ->line('Thank you !');
    }
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'body' => "Congratulations, you have become the users manager.",
            'icon' => 'bi bi-people',
            'ink' => route('/'),


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
