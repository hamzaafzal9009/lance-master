<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'two_factor_expires_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'user_type',
        'verified',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfle', 'u_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\VideoContent', 'u_id', 'id');
    }

    public function continueWatches()
    {
        return $this->hasMany('App\Models\ContinueWatch', 'u_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\History', 'u_id', 'id');
    }

    public function playlists()
    {
        return $this->hasMany('App\Models\Playlist', 'u_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notifies', 'notification_to_id', 'id');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function subscribers()
    {
        return $this->belongsToMany('App\Models\User', 'subscribers', 'account_id', 'subscriber_id', 'id');
    }

    public function subscribedTo()
    {
        return $this->belongsToMany('App\Models\User', 'subscribers', 'subscriber_id', 'account_id', 'id');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }
}
