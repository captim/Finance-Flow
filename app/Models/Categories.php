<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'users_id',
        'types_id'
    ];

    function user()
    {
      return $this->belongsTo('App\Models\User', 'users_id');
    }

    function type()
    {
      return $this->belongsTo('App\Models\Types', 'types_id');
    }
}
