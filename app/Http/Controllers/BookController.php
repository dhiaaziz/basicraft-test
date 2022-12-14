<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function token(){
        return csrf_token();
    }

    public function index()
    {
        // dd('test_book');
        return view('admin.books.index');
    }

    public function fetch()
    {
        $books = \App\Models\Book::all();
        // dd($books);
        return response()->json([

            'data' => $books
        ]);
        // return view('books.index');
    }

    //fetch available books
    public function fetch_available()
    {

        $books = \App\Models\Book::whereNotIn('id_book', function($query){
            $query->select('id_book')->from('books_outs')
            ->whereNull('date_in_actual');
        })->get();
        // dd($books);
        return response()->json([

            'data' => $books
        ]);
        // return view('books.index');
    }

    //fetch borrowed books
    public function fetch_borrowed()
    {

        $books = \App\Models\Book::whereIn('id_book', function($query){
            $query->select('id_book')->from('books_outs')
            ->whereNull('date_in_actual');
        })->get();
        // dd($books);
        return response()->json([

            'data' => $books
        ]);
        // return view('books.index');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $book = new \App\Models\Book();
        // $book = $request->all();
        $book->title = $request->title;
        // dd($book);
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->published = $request->published;
        $book->is_active = $request->is_active;
        $book->created = now();
        $book->updated = now();
        $book->save();
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $book = \App\Models\Book::where('id_book', $id)->first();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->published = $request->published;
        $book->is_active = $request->is_active;
        $book->updated = now();
        $book->save();
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = \App\Models\Book::where('id_book', $id)->first();
        $book->delete();
        return response()->json($book);
    }
}
