<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'text',
        'expire_at',
        'send_to'
    ];

    protected $appends = ['created_at_friendly'];

    /**
     * Users affected by the notification
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications', 'notification', 'user');
    }

    /**
     * Mutator for send to attribute (serialize from array)
     */
    public function setSendToAttribute($value)
    {
        $this->attributes['send_to'] = is_array($value) ? serialize($value) : $value;
    }

    /**
     * Accessor for send to attribute (unserialize from array)
     */
    public function getSendToAttribute($value)
    {
        return !is_null($value) ? unserialize($value) : $value;
    }    

    /**
     * Mutator for date
     */
    public function setExpireAtAttribute($value)
    {
        $this->attributes['expire_at'] = new Carbon($value);
    }    

    /**
     * Friendly created at date
     */
    public function getCreatedAtFriendlyAttribute()
    {
        $carbon = new Carbon($this->created_at);

        return $carbon->format('d M Y H:i:s');
    }

}
