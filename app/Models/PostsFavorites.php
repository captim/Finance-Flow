<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsFavorites extends Model
{
    use HasFactory;

    protected $table = 'posts_favorites';

    protected $fillable = [
        'users_id',
        'posts_id'
    ];
}
