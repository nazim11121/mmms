<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'age_from', 'age_to', 'height_from', 'height_to',
        'religion', 'caste', 'marital_status', 'education', 'occupation',
        'country', 'district', 'annual_income_from', 'annual_income_to', 'about_partner',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
