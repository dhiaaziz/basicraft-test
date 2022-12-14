<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksOut extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_book',
        'id_member',
        'date_out',
        'date_in',
        'date_in_actual',
        'is_active',
        'created',
        'updated',
    ];

    protected $casts = [
        'date_out' => 'datetime:d-m-Y',
        'date_in' => 'datetime:d-m-Y',
        'date_in_actual' => 'datetime:d-m-Y',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    protected $primary = 'id_books_out';

    public function book()
    {
        return $this->belongsTo(Books::class, 'id_book');
    }

    public function member()
    {
        return $this->belongsTo(Members::class, 'id_member');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
