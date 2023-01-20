<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'show_notification'
    ];

    protected $appends = [
        'active_notification_count'
    ];    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The notifications of the user.
     */
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notifications', 'user', 'notification');
    }    

    /**
     * The active notifications of the user.
     */
    public function activeNotifications()
    {
        return $this->notifications()->wherePivot('read', 0)->where('expire_at', '>', Carbon::now());
    }    

    /**
     * Accessor - active notification count of user.
     */
    protected function getActiveNotificationCountAttribute()
    {
        return $this->activeNotifications()->count();
    }    
}
