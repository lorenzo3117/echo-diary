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
        return ['mail', 'database'];
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // TODO hardcoded data, wouldn't show updates
        return [
            'post_id' => $this->createdPost->id,
            'user_id' => $this->createdPost->user->id,
        ];
    }

    /**
     * Determine if the notification should be sent.
     */
    public function shouldSend(object $notifiable, string $channel): bool
    {
        return $this->createdPost->isFirstTimePublishing();
    }
}
