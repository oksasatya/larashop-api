<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    use HasFactory;

    protected $fillable  = [
        'title',
        'slug',
        'description',
        'author',
        'publisher',
        'cover',
        'price',
        'weight',
        'stock',
        'status'
    ];

    use SoftDeletes;
    protected $dates = [
        'deleted_at'
    ];
}
