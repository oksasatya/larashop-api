<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'books_category';

    protected $fillable = [
        'book_id',
        'category_id',
        'invoice_number',
        'status'

    ];
}
