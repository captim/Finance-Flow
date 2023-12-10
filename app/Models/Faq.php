<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'title',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
    ];
}
