<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    public $timestamps = false;
    protected $fillable = [
        'attendance_date',
        'course_user_id',
        'is_present',
    ];

    public function courseUser(): BelongsTo
    {
        return $this->belongsTo(CourseUser::class);
    }
}
