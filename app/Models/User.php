<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'google_id',
        'email',
        'password',
        'saldo',
        'last_activity',
        'avatar',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'saldo',
        'admin',
        'google_id',
    ];

    protected $dates = ['last_activity'];

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

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?? 'path/to/default/avatar.png';
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Item::class,
            'owner',
            'item_id',
            'id',
            'id'
        );
    }

    public function averageRating()
    {
        return $this->reviews()->avg('star');
    }

    public function isOnline()
    {
        return $this->last_activity > now()->subMinutes(5);
    }
    public static function getUserAvatar($id)
    {
        // Fetch the user by ID
        $user = self::find($id);

        // Check if the user exists and has an avatar
        if ($user && $user->avatar) {
            return $user->avatar; // Return the avatar URL or path
        }

        // Return a default avatar or placeholder if no avatar is set
        return 'path/to/default/avatar.png';
    }
}