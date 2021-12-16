<?php


use app\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//hubung ke controller
use App\Http\Controllers;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;


// Middleware adalah perangkat lunak komputer yang memberikan 
// layanan untuk menghubungkan bagian-bagian berbeda dari sebuah aplikasi dengan sistem operasi

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('cek', function () {
        return ['Halo Laravel'];
    });
    Route::get('book', [BookController::class, 'index']);
    Route::get('book/{id}',[BookController::class, 'show']);
    Route::post('book' ,[BookController::class, 'add']);
    Route::put('book/update/{id}', [BookController::class, 'update']);
    Route::delete('book/delete/{id}', [BookController::class, 'delete']);
    Route::post('logout', [AuthController::class, 'logout']);
    
});

//menghubungkan ke controller/model dengan routing
//Routing adalah suatu protokol yang digunakan untuk 
//mendapatkan rute dari satu jaringan ke jaringan yang lain
