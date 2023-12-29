<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_user';
    public $timestamps = false;
    protected $fillable = [
        'course_id',
        'user_id',
        'is_fee',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function session(): HasOne
    {
        return $this->hasOne(Session::class);
    }
}
