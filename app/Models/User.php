<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo_profile',
        'short_bio',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Accessor foto profile (best practice)
     */
    public function getPhotoProfileAttribute($value)
    {
        return $value
            ? asset('storage/' . $value)
            : asset('images/default.png');
    }
    // About (1 user = 1 about)
    public function about()
    {
        return $this->hasOne(\App\Models\About::class);
    }

    // Skills (1 user = banyak skill)
    public function skills()
    {
        return $this->hasMany(\App\Models\Skill::class);
    }

    // Experiences
    public function experiences()
    {
        return $this->hasMany(\App\Models\Experience::class);
    }

    // Projects
    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class);
    }

    // Contacts
    public function contacts()
    {
        return $this->hasMany(\App\Models\Contact::class);
    }
}
