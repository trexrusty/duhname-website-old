<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\PostLiked;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['post_id', 'comment_id', 'user_id'];


    protected static function booted()
    {
        static::created(function ($like) {
            if ($like->post->owner_id !== $like->user->id || $like->post->owner_id == $like->user->id) {
                $like->post->owner->notify(new PostLiked($like->post, $like->user));
            }
        });

        static::deleted(function ($like) {

        });
    }


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public static function hasLikedPost(Post $post, User $user)
    {
        return static::where('post_id', $post->id)->where('user_id', $user->id)->exists();
    }

    public static function hasLikedComment(Comment $comment, User $user)
    {
        return static::where('comment_id', $comment->id)->where('user_id', $user->id)->exists();
    }
}
