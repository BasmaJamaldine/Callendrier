<?php

use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::all();

 
    return view('dashboard', ['posts' => $posts]);
 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/post',[PostController::class, 'index'])->name('post');
    Route::post('/post',[PostController::class, 'store'])->name('post.store');
    Route::delete('/post/destroy/{post}',[PostController::class, 'destroy'])->name('post.destroy');
    // Route::resource('post',[PostController::class]);
    // Route::resource('/Calendrier', CalendrierController::class);
   
    Route::get('/calendrier', [CalendrierController::class,'index'])->name('calendrier');
    Route::post('/calendrier/store', [CalendrierController::class,'store'])->name('calender.store');
    Route::get('/calendar/create', [CalendrierController::class,'create'])->name('calender.create');
});

require __DIR__.'/auth.php';
