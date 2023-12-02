<?php

namespace App\Notifications;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsNotification extends Notification
{
    use Queueable;
    /**
     * @var \App\Models\News
     *
     */
    protected $news;
    /**
     * Create a new notification instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
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
                    ->subject('news')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('A new News has been created.')
                    ->action('View News', route('news.getnews'))
                    ->line('Thank you !');
    }
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'body' => "A new News has been created.",
            'icon' => 'bi bi-newspaper',
            'ink' => route('news.getnews'),

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
