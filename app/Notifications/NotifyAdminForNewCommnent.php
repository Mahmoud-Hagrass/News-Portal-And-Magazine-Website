<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAdminForNewCommnent extends Notification
{
    use Queueable;
    public $comment , $post ;
    /**
     * Create a new notification instance.
     */
    public function __construct($comment  , $post)
    {
        $this->comment = $comment ; 
        $this->post = $post ;
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
            'created_at' => $this->comment->created_at->format('m-d-Y H:m a') ?? null,
            'link' => $this->post ? route('frontend.post.show', $this->post->slug) : '#',
        ] ; 
    }

    public function toBroadcast(object $notifiable)
    {
        return [
            'post_title' => $this->post->title ?? 'No Title',
            'post_id' => $this->post->id ?? null,
            'comment' => $this->comment->comment ?? 'No Comment',
            'user_id' => $this->comment->user_id ?? null,
            'created_at' => $this->comment->created_at->format('m-d-Y H:m a') ?? null,
            'link' => $this->post ? route('frontend.post.show', $this->post->slug) : '#',
        ];
    }

    public function databaseType(object $notifiable):string
    {
        return 'NotifyAdminForNewComment' ;
    }

    public function broadcastType():string
    {
        return 'NotifyAdminForNewComment' ;
    }
}
