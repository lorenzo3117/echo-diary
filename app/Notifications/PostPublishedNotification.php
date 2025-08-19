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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $postTitle = $this->createdPost->title;
        $creatorUsername = $this->createdPost->user->username;
        $notifiableUsername = $notifiable->username;

        return (new MailMessage)
            ->subject('New post by ' . $creatorUsername)
            ->greeting('Hello ' . $notifiableUsername . ',')
            ->line(new HtmlString('<strong>' . $creatorUsername . '</strong> published a new post:'))
            ->line(new HtmlString('<strong>' . $postTitle . '</strong>'))
            ->action('View post', url(route('post.show', $this->createdPost)));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
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
