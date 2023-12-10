<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsComments extends Model
{
    use HasFactory;

    protected $table = 'posts_comments';

    protected $fillable = [
        'users_id',
        'posts_id',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
    ];

    function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
