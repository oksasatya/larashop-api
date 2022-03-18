<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'category_id',
        'invoice_number',
        'status'
    ];
}
