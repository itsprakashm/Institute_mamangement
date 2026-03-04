<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'module', 'record_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quickly create a log entry from anywhere in the application.
     */
    public static function log(string $action, string $module, ?int $recordId = null, ?string $description = null): void
    {
        static::create([
            'user_id'     => Auth::id(),
            'action'      => $action,
            'module'      => $module,
            'record_id'   => $recordId,
            'description' => $description,
        ]);
    }
}
