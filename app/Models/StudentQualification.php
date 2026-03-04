<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'degree', 'stream', 'board', 'passing_year', 'marks_percentage',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
