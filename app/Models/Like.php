<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['post_id', 'comment_id', 'user_id'];

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

    public function hasLikedPost(Post $post, User $user)
    {
        return $this->where('post_id', $post->id)->where('user_id', $user->id)->exists();
    }

    public function hasLikedComment(Comment $comment, User $user)
    {
        return $this->where('comment_id', $comment->id)->where('user_id', $user->id)->exists();
    }
}
