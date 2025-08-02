<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PostPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Post $createdPost)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $creatorUsername = $this->createdPost->user->username;
        $notifiableUsername = $notifiable->username;

        return (new MailMessage)
            ->subject('New post by ' . $creatorUsername)
            ->greeting('Hello ' . $notifiableUsername . ',')
            ->line(new HtmlString('A new post has been published by <strong>' . $creatorUsername . '</strong>!'))
            ->action('View the post here.', url(route('post.show', $this->createdPost)));
    }

    /**
     * Determine if the notification should be sent.
     */
    public function shouldSend(object $notifiable, string $channel): bool
    {
        return $this->createdPost->isPublished();
    }
}
