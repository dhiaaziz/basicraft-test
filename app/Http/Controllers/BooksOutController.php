<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksOutController extends Controller
{
    //
    public function borrow_index()
    {

        // return view('books_out.index', compact('booksOut'));
        return view('admin.books.borrow.index');
    }

    public function return_index()
    {
        // return view('books_out.index', compact('booksOut'));
        return view('admin.books.return.index');
    }
}
