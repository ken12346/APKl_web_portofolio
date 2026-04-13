<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'user_id',
        'description',
        'professional_vision',
        'mission',
        'location',
        'date_of_birth',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Relasi ke User (belongsTo)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
