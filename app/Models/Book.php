<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'status',
        'genre',
        'year',
        'read_in',
        'user_id'
    ];
}
