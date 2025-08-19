<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CommentPostedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Comment $postedComment)
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
        $postTitle = $this->postedComment->post->title;
        $commentMessage = $this->postedComment->message;
        $creatorUsername = $this->postedComment->user->username;
        $notifiableUsername = $notifiable->username;

        return (new MailMessage)
            ->subject('New comment by ' . $creatorUsername)
            ->greeting('Hello ' . $notifiableUsername . ',')
            ->line(new HtmlString('<strong>' . $creatorUsername . '</strong> posted a comment on your post ' . '<strong>' . $postTitle . '</strong>:'))
            ->line(new HtmlString('<strong>' . $commentMessage . '</strong>'))
            ->action('View comment', url(route('post.show', $this->postedComment->post))  . '#comments');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->postedComment->id,
            'post_id' => $this->postedComment->post->id,
            'user_id' => $this->postedComment->user->id,
        ];
    }
}
