<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('books.{bookId}', function (User $user, int $bookId) {
    $book = Book::findOrFail($bookId);

    return $user->id === $book->submitted_by;
});

Broadcast::channel('users.{userId}', function (User $user, int $userId) {
    $broadcastUser = User::findOrFail($userId);

    return $user->id === $broadcastUser->id;
});
