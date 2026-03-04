<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'monthly_fee', 'description'];

    public function studentClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
