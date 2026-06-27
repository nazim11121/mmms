<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shortlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shortlisted_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shortlistedUser()
    {
        return $this->belongsTo(User::class, 'shortlisted_user_id');
    }
}
