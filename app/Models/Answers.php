<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'description',
        'users_id',
        'questions_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
    ];

    function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
