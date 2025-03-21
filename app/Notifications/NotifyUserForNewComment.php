<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotifyUserForNewComment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $comment, $post;
    public function __construct($comment, $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database' , 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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

    public function toDatabase(object $notifiable)
    {
        return [
            'post_title' => $this->post->title ?? 'No Title',
            'post_id' => $this->post->id ?? null,
            'comment' => $this->comment->comment ?? 'No Comment',
            'user_id' => $this->comment->user_id ?? null,
            'link' => $this->post ? route('frontend.post.show', $this->post->slug) : '#',
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'post_title' => $this->post->title ?? 'No Title',
            'post_id' => $this->post->id ?? null,
            'comment' => $this->comment->comment ?? 'No Comment',
            'user_id' => $this->comment->user_id ?? null,
            'link' => $this->post ? route('frontend.post.show', $this->post->slug) : '#',
        ];
    }

    public function databaseType(object $notifiable):string
    {
        return 'NotifyUserForNewComment' ;
    }

    public function broadcastType():string
    {
        return 'NotifyUserForNewComment' ;
    }
}
