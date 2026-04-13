<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'user_id',
        'project_title',
        'project_type',
        'client_name',
        'role',
        'start_date',
        'end_date',
        'is_ongoing',
        'description',
        'technologies',
        'project_url',
        'github_url',
        'thumbnail',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_ongoing' => 'boolean',
    ];

    /**
     * Relasi ke User (belongsTo)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor: URL thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail
            ? Storage::url($this->thumbnail)
            : url('/images/default-project.png');
    }

    /**
     * Accessor: durasi project
     */
    public function getDurationAttribute()
    {
        $start = $this->start_date?->format('M Y');
        $end = $this->is_ongoing
            ? 'Present'
            : $this->end_date?->format('M Y');

        return $start && $end ? "$start - $end" : null;
    }
    public function setTechnologiesAttribute($value)
    {
        $this->attributes['technologies'] = json_encode($value);
    }

    public function getTechnologiesAttribute($value)
    {
        return json_decode($value, true);
    }
}
