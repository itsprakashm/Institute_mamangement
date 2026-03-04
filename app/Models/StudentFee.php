<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'month', 'amount', 'status', 'paid_date', 'remark'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
