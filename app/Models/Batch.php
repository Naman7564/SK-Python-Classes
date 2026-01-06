<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Batch extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the course that this batch belongs to
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the users (students) that belong to this batch
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'batch_user')
            ->withTimestamps();
    }

    /**
     * Get only students (not admins) in this batch
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'batch_user')
            ->where('role', 'student')
            ->withTimestamps();
    }
}
