<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'student_id',
        'class_id',
        'grade_type',
        'assignment_id',
        'score',
        'teacher_id',
        'graded_at',
        'feedback',
    ];

    protected $casts = [
        'graded_at' => 'datetime',
        'score' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Học viên
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Lớp
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    // Bài tập (nullable)
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Giáo viên chấm
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}