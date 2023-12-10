<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'description',
        'preview',
        'users_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
    ];

    function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    function favorite() {
        return $this->hasOne('App\Models\PostsFavorites')->where('users_id', Auth::id());
    }

    function comments() {
        return $this->hasMany('App\Models\PostsComments');
    }
}
