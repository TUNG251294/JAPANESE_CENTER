<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'actual_session',
        'course_user_id',
        'rate'
    ];

    public function courseUser(): BelongsTo
    {
        return $this->belongsTo(CourseUser::class);
    }
}
