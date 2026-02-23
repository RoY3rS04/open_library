<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'create']);

Route::post('/register', [AuthController::class, 'store']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/login', [AuthController::class, 'loginView'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/verify', function () {
    return view('Mail.confirm_email');
});

Route::get('/books/create', function () {

});
