<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "friend_id",
        "status",
        "accepted_at",
    ];
     /**
     * Get the user that owns the notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function freind(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freind_id');
    }
}
