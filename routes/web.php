<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([
    'prefix' => 'admin', 
    // 'middleware' => ['auth', 'verified']
    ], function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.dashboard');
});

Route::group([
    'prefix' => 'books', 
    // 'middleware' => ['auth', 'verified']
    ], function () {
        Route::controller(BookController::class)->group(function () {
            ROute::get('/token', 'token');
            Route::get('/', 'index')->name('books.index');
            Route::get('/fetch', 'fetch')->name('books.fetch');
            Route::get('/create', 'create')->name('books.create');
            Route::post('/store', 'store')->name('books.store');
            Route::get('/{book}/edit', 'edit')->name('books.edit');
            Route::put('/{book}/update', 'update')->name('books.update');
            Route::delete('/{book}/destroy', 'destroy')->name('books.destroy');
        });
        // Route::get('/', 'BookController@index');
        // Route::get('/create', 'BookController@create');
        // ->name('admin.users');
});

Route::group([
    'prefix' => 'users', 
    // 'middleware' => ['auth', 'verified']
    ], function () {
        Route::controller('App\Http\Controllers\UserController')->group(function () {
            Route::get('/', 'index')->name('users.index');
            Route::get('/fetch', 'fetch')->name('users.fetch');
            Route::get('/create', 'create')->name('users.create');
            Route::post('/store', 'store')->name('users.store');
            Route::get('/{user}', 'show')->name('users.show');
            Route::get('/{user}/edit', 'edit')->name('users.edit');
            Route::put('/{user}/update', 'update')->name('users.update');
            Route::delete('/{user}/destroy', 'destroy')->name('users.destroy');
        });
        // Route::get('/', 'BookController@index');
        // Route::get('/create', 'BookController@create');
        // ->name('admin.users');
});

Route::group([
    'prefix' => 'members', 
    // 'middleware' => ['auth', 'verified']
    ], function () {
        Route::controller('App\Http\Controllers\MemberController')->group(function () {
            Route::get('/', 'index')->name('members.index');
            Route::get('/fetch', 'fetch')->name('members.fetch');
            Route::get('/create', 'create')->name('members.create');
            Route::post('/store', 'store')->name('members.store');
            Route::get('/{member}', 'show')->name('members.show');
            Route::get('/{member}/edit', 'edit')->name('members.edit');
            Route::put('/{member}/update', 'update')->name('members.update');
            Route::delete('/{member}/destroy', 'destroy')->name('members.destroy');
        });
        // Route::get('/', 'BookController@index');
        // Route::get('/create', 'BookController@create');
        // ->name('admin.users');
});

Route::group([
    'prefix' => 'booksout', 
    // 'middleware' => ['auth', 'verified']
    ], function () {
        Route::controller(BooksOutController::class)->group(function () {
            Route::get('/', 'index')->name('booksout.index');
            Route::get('/fetch', 'fetch')->name('booksout.fetch');
            Route::get('/create', 'create')->name('booksout.create');
            Route::post('/store', 'store')->name('booksout.store');
            Route::get('/{booksout}/edit', 'edit')->name('booksout.edit');
            Route::put('/{booksout}/update', 'update')->name('booksout.update');
            Route::delete('/{booksout}/destroy', 'destroy')->name('booksout.destroy');
        });
        // Route::get('/', function () {
        //     return view('booksout.index');
        // })->name('booksout.index');
});

require __DIR__.'/auth.php';
