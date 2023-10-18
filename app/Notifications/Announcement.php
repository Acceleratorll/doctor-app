<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Announcement extends Notification
{
    use Queueable;

    protected $title;
    protected $content;
    protected $created_at;

    public function __construct($title, $content, $created_at)
    {
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'content' => $this->content,
            'title' => $this->title,
            'created_at' => $this->created_at,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'content' => $this->content,
            'title' => $this->title,
            'created_at' => $this->created_at,
        ];
    }
}
