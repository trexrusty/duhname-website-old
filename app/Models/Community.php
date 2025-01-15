<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Community extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'description', 'logo', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user', 'community_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'community_id', 'post_id', 'id');
    }

}
