<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;
use App\Models\User;

class PostLiked extends Notification
{
    use Queueable;

    protected $post;
    protected $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add 'mail' if you want email notifications
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->user->username . ' liked your post',
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ];
    }
}
