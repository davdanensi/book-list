<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_id',
        'small_thumbnail',
        'thumbnail',
        'title',
        'subtitle',
        'authors'
    ];
}
