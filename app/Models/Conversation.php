<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user1_id', 'user2_id', 'last_message_id', 'last_message_at'];

    protected function casts(): array
    {
        return ['last_message_at' => 'datetime'];
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getOtherUser(int $userId): User
    {
        return $this->user1_id === $userId ? $this->user2 : $this->user1;
    }

    public static function getOrCreate(int $user1Id, int $user2Id): self
    {
        $minId = min($user1Id, $user2Id);
        $maxId = max($user1Id, $user2Id);
        return self::firstOrCreate(['user1_id' => $minId, 'user2_id' => $maxId]);
    }
}
