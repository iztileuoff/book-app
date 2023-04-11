<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Basket\BasketController;
use App\Http\Controllers\Api\Book\BookController;
use App\Http\Controllers\Api\Favourite\FavouriteController;
use App\Http\Controllers\Api\Gener\GenerController;
use App\Http\Controllers\Api\Quote\QuoteController;
use App\Http\Controllers\Api\Review\ReviewController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'registration'])->middleware('guest');
    Route::post('login', [AuthController::class, 'authenticate'])->middleware('guest');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('check', [AuthController::class, 'check'])->middleware('auth:sanctum');
});

// Api routes with sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {

    // users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);

    // quotes
    Route::get('quotes', [QuoteController::class, 'index']);
    Route::post('quotes', [QuoteController::class, 'store']);
    Route::get('quotes/{quote}', [QuoteController::class, 'show']);
    Route::put('quotes/{quote}', [QuoteController::class, 'update']);
    Route::delete('quotes/{quote}', [QuoteController::class, 'destroy']);

    // geners
    Route::get('geners', [GenerController::class, 'index']);
    Route::post('geners', [GenerController::class, 'store']);
    Route::get('geners/{gener}', [GenerController::class, 'show']);
    Route::put('geners/{gener}', [GenerController::class, 'update']);
    Route::delete('geners/{gener}', [GenerController::class, 'destroy']);

    // books
    Route::get('books', [BookController::class, 'index']);
    Route::post('books', [BookController::class, 'store']);
    Route::get('books/{book}', [BookController::class, 'show']);
    Route::put('books/{book}', [BookController::class, 'update']);
    Route::delete('books/{book}', [BookController::class, 'destroy']);

    // favourites
    Route::get('favourites', [FavouriteController::class, 'index']);
    Route::post('favourites', [FavouriteController::class, 'store']);
    Route::get('favourites/{favourite}', [FavouriteController::class, 'show']);
    Route::put('favourites/{favourite}', [FavouriteController::class, 'update']);
    Route::delete('favourites/{favourite}', [FavouriteController::class, 'destroy']);

    // baskets
    Route::get('baskets', [BasketController::class, 'index']);
    Route::post('baskets', [BasketController::class, 'store']);
    Route::get('baskets/{basket}', [BasketController::class, 'show']);
    Route::put('baskets/{basket}', [BasketController::class, 'update']);
    Route::delete('baskets/{basket}', [BasketController::class, 'destroy']);

    // reviews
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::get('reviews/{review}', [ReviewController::class, 'show']);
    Route::put('reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy']);

});
