<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'subject', 'icon'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper to quickly log an action.
     */
    public static function log(string $action, string $subject, string $icon = '📝', $userId = null)
    {
        static::create([
            'user_id' => $userId ?? auth()->id(),
            'action'  => $action,
            'subject' => $subject,
            'icon'    => $icon,
        ]);
    }
}
