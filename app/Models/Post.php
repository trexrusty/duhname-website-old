<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['content', 'owner_id', 'community_id', 'likes_count', 'comments_count', 'views_count', 'parent_id'];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likePost()
    {
        $this->increment('likes_count');
    }

    public function unlikePost()
    {
        $this->decrement('likes_count');
    }

    public function toggleLike(User $user)
    {
        if ($user->hasLikedPost($this)) {
            $user->likes()->where('post_id', $this->id)->delete();
            $this->unlikePost();
            return false;
        }
        else
        {
            Like::create([
                'post_id' => $this->id,
                'user_id' => $user->id,
            ]);
            $this->likePost();
            return true;
        }
    }
}
