<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'text',
        'expire_at',
        'send_to'
    ];

    /**
     * Users affected by the notification
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications', 'notification', 'user');
    }    
}
