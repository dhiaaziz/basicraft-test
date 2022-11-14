<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'address',
        'dob',
        'is_active',
        'created',
        'updated',
    ];

    protected $casts = [
        'dob' => 'date:d-m-Y',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    // prrimary
    protected $primaryKey = 'id_member';
    public $timestamps = false;

}
