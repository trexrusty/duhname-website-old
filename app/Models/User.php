<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, HasRoles;

    protected $table = 'users';
    public $incrementing = false;

    public $icon_url;
    protected static function booted()
    {
        static::created(function ($user) {
            $user->assignRole('Verified');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'tag',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getIconUrlAttribute()
    {
        return $this->icon ? Storage::url($this->icon) : null;
    }

    public function is_verified()
    {
        return $this->hasRole('Verified');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'owner_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_user', 'user_id', 'community_id');
    }

    public function communitiesOwned()
    {
        return $this->hasMany(Community::class, 'owner_id');
    }

    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function hasLikedComment(Comment $comment)
    {
        return $this->likes()->where('comment_id', $comment->id)->exists();
    }
}
