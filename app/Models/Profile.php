<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gender', 'date_of_birth', 'height', 'weight', 'blood_group',
        'religion', 'caste', 'mother_tongue', 'nationality', 'country', 'division',
        'district', 'address', 'marital_status', 'have_children', 'no_of_children',
        'occupation', 'organization', 'annual_income', 'education_level', 'university',
        'about_me', 'profile_created_by', 'is_verified', 'is_featured', 'completeness',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'have_children' => 'boolean',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }

    public function getHeightFtAttribute(): ?string
    {
        if (!$this->height) return null;
        $inches = $this->height / 2.54;
        $feet = floor($inches / 12);
        $in = round($inches % 12);
        return "{$feet}' {$in}\"";
    }
}
