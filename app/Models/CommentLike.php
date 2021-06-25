<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function comment()
    {
        $this->belongsTo('App\Models\Comment', 'comment_id', 'id');
    }

}
