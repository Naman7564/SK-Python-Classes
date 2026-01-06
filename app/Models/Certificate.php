<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_number',
        'issue_date',
        'expiry_date',
        'certificate_pdf',
        'status',
        'notes'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Generate unique certificate number
     */
    public static function generateCertificateNumber()
    {
        do {
            $number = 'CERT-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8)) . '-' . date('Y');
        } while (self::where('certificate_number', $number)->exists());

        return $number;
    }
}
