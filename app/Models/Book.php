<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published',
        'is_active',
        'created',
        'updated',
    ];

    protected $casts = [
        // 'published' => 'datetime',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    // id
    protected $primaryKey = 'id_book';
    public $timestamps = false;
}
