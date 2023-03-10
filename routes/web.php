<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Home;
use App\Http\Livewire\SinglePost;
use App\Http\Livewire\VideoPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(["auth", "verified", 'VerifiedUser'])->group(function () {
    Route::get('/', Home::class)->name("home");
    Route::get('/videos', VideoPosts::class)->name("videos");
    Route::get('/post/{useruuid}/{postuuid}', SinglePost::class)->name("single-post");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
