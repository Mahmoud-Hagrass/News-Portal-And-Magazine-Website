<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactAdminNotify extends Notification
{
    use Queueable;
    public $contact ;
    /**
     * Create a new notification instance.
     */
    public function __construct($contact)
    {
        $this->contact = $contact ;
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

    public function toDatabase(object $notifiable):array
    {
        return [
            'contact_name' => $this->contact->name , 
            'contact_subject' => $this->contact->subject , 
            'contact_created_at' => $this->contact->created_at, 
            'link' => route('admin.contacts.show' , $this->contact->id) ?? 'No Link' ,
        ] ;
    }
    public function toBroadcast(object $notifiable):array
    {
        return [
            'contact_name' => $this->contact->name ?? 'No Name' , 
            'contact_subject' => $this->contact->subject ?? 'No Subject' , 
            'contact_created_at' => $this->contact->created_at->diffForHumans() ?? 'No Date' ,
            'link' => route('admin.contacts.show' , $this->contact->id) ?? 'No Link' ,
        ] ;
    }

    // custom notification type in database
    public function databaseType(object $notifiable):string
    {
        return 'NewContactAdminNotify' ;
    }

    // custom notification type in broadcast
    public function broadcastType():string
    {
        return 'NewContactAdminNotify' ;
    }
}
