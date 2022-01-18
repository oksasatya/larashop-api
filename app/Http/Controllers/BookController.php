<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index()
    {


        $books = new book();
        $books->title = 'learn-vue js';
        $books->slug = Str::slug($books->title);
        $books->description = 'contoh';
        $books->author = 'contoh juga';
        $books->publisher = 'oksa';
        $books->cover = '1.jpg';
        $books->save();
    }


    public function cetak($judul)
    {
        return $judul;
    }

    public function view($id)
    {
        $book = DB::select('select * from books where id = ?', [$id]);
        return $book;
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
}
