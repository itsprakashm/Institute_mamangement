<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admission_no',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'photo',
        'guardian_name',
        'guardian_phone',
        'address',
        'class_id',
        'batch_id',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getEmailAttribute()
    {
        return $this->user ? $this->user->email : 'N/A';
    }

    public function studentClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public static function generateAdmissionNo()
    {
        $year = date('Y');
        $prefix = "MBC-{$year}-";
        $last = static::where('admission_no', 'like', $prefix . '%')
            ->orderBy('admission_no', 'desc')
            ->first();

        if ($last) {
            $num = (int) substr($last->admission_no, -4);
            $next = $num + 1;
        } else {
            $next = 1;
        }

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
