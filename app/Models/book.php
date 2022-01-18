<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
