<?php
use App\Http\Controllers\PostController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts/{id}/status', [PostController::class, 'updateStatus']);
    Route::get('/posts/{id}/call', [PostController::class, 'makeCall']);
    Route::post('/posts/{id}/call-status', [PostController::class, 'updateCallStatus']);

});

require __DIR__ . '/auth.php';
