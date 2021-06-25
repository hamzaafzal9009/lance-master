<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VideoContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'video',
        'videoname',
        'video_path',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault(function ($data) {
            foreach ($data->getFillable() as $dt) {
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function continueWatches()
    {
        $user = Auth::user();
        // return $user; 
        $comments = $this->hasMany('App\Models\ContinueWatch', 'v_id', 'id')->where('u_id', $user->id)->latest();        
        return $comments;
    }

    public function views()
    {
        return  $this->hasMany('App\Models\ContinueWatch', 'v_id', 'id')->latest();        
        // return $this->hasMany('App\Models\ContinueWatch', 'v_id', 'id')->get();        
        // return $this->hasMany('App\Models\View', 'v_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\History', 'v_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'u_id', 'id');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Models\Playlist', 'video_playlists', 'video_id', 'playlist_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'video_id', 'id')->whereNull('parent_id');
    }
}
