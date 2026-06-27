<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'phone',
        'avatar', 'last_seen', 'is_online', 'profile_complete',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen' => 'datetime',
            'password' => 'hashed',
            'is_online' => 'boolean',
            'profile_complete' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function partnerPreference()
    {
        return $this->hasOne(PartnerPreference::class);
    }

    public function photos()
    {
        return $this->hasMany(ProfilePhoto::class);
    }

    public function primaryPhoto()
    {
        return $this->hasOne(ProfilePhoto::class)->where('is_primary', true);
    }

    public function sentInterests()
    {
        return $this->hasMany(Interest::class, 'sender_id');
    }

    public function receivedInterests()
    {
        return $this->hasMany(Interest::class, 'receiver_id');
    }

    public function shortlists()
    {
        return $this->hasMany(Shortlist::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('expires_at', '>', now());
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        $photo = $this->primaryPhoto;
        if ($photo) {
            return asset('storage/' . $photo->photo_path);
        }
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        $gender = $this->profile?->gender ?? 'male';
        return asset('images/default-' . $gender . '.png');
    }

    public function isPremium(): bool
    {
        return $this->activeSubscription !== null;
    }
}
