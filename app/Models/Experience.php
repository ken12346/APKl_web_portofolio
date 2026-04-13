<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'user_id',
        'position_title',
        'organization_name',
        'start_date',
        'end_date',
        'is_current',
        'description',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    /**
     * Relasi ke User (belongsTo)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
