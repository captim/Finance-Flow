<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class UserDates extends Model
{
    use HasFactory;

    protected $table = 'user_dates';

    protected $fillable = [
        'date',
        'sum',
        'comment',
        'users_id',
        'categories_id',
        'types_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    function category()
    {
      return $this->belongsTo('App\Models\Categories', 'categories_id');
    }

    function type()
    {
      return $this->belongsTo('App\Models\Types', 'types_id');
    }
}
