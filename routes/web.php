<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
   Route::get('/', function () {
       return view('welcome');
   });
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    })->middleware('signed')->name('verification.verify');

    Route::get('/books/create', [BookController::class, 'create']);
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{book}', [BookController::class, 'show']);

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create']);

    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'loginView'])->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});



Route::get('/verify', function () {
    return view('Mail.confirm_email');
});
