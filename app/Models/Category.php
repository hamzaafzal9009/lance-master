<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'photo', 'is_featured', 'image'];

    public function video()
    {
        return $this->hasMany('App\Models\VideoContent');
    }
}
