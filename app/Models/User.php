<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
}
