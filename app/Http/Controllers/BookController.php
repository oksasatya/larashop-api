<?php

namespace App\Http\Controllers;

use App\Http\Resources\Books as BooksResource;
use App\Models\book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index()
    {
        $books = book::paginate(6);
        return new BooksResource($books);
    }


    public function cetak($judul)
    {
        return $judul;
    }


    public function show()
    {
        $books = DB::table('books')->pluck('id', 'title');

        foreach ($books as $id => $title) {
            echo $title;
        }
    }

    public function destroy(Book $book)
    {
        $book->destroy([8, 9]);

        return 'succesfully Deleted';
    }


    public function top($count)
    {
        $criteria = Book::orderBy('views', 'desc')->take($count)->get();
        return new BooksResource($criteria);
    }
}
