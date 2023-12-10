<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'description',
        'users_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
    ];

    function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    function answers()
    {
        return $this->hasMany('App\Models\Answers');
    }
}
