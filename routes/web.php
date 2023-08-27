<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PhotoCommentController;
use App\Http\Controllers\ProfilePictureController;

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
    Route::get('/profile/my_photos', [ProfileController::class, 'photos'])->name('profile.photos');
    Route::get('/profile/my_likes', [ProfileController::class, 'likes'])->name('profile.likes');
    Route::get('/profile/my_follows', [ProfileController::class, 'follows'])->name('profile.follows');

    Route::patch('/profile/avi/update', [ProfilePictureController::class, 'update'])->name('profile.picture.update');
    Route::delete('/profile/avi/delete', [ProfilePictureController::class, 'destroy'])->name('profile.picture.destroy');

    Route::get('/explore', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/feed', [PhotoController::class, 'feed'])->name('photos.feed');
    Route::get('/photos/upload', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos/upload', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('/photos/view/{photo:id}', [PhotoController::class, 'show'])->name('photos.show');
    Route::get('/photos/edit/{photo:id}', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::patch('/photos/edit/{photo:id}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/edit/{photo:id}/delete', [PhotoController::class, 'destroy'])->name('photos.destroy');

    Route::get('/photos/view/{photo:id}/likers', [PhotoController::class, 'view_likers'])->name('photos.likers');

    Route::get('/photos/view/{photo:id}/comments', [PhotoCommentController::class, 'show'])->name('photos.comment.show');
    Route::post('/photos/view/{photo:id}/comment', [PhotoCommentController::class, 'store'])->name('photos.comment.store');
    Route::get('/photos/view/{photo:id}/comment/{comment:id}/edit', [PhotoCommentController::class, 'edit'])->name('photos.comment.edit');
    Route::patch('/photos/view/{photo:id}/comment/{comment:id}/edit', [PhotoCommentController::class, 'update'])->name('photos.comment.update');

    Route::delete('/photos/view/{photo:id}/comment/{comment:id}/delete', [PhotoCommentController::class, 'destroy'])->name('photos.comment.destroy');

    Route::get('/users/{user:id}',[UserController::class, 'show'])->name('users.show');

    Route::post('/users/{user:id}/follow',FollowerController::class)->name('follow.user');
    Route::post('/photos/view/{photo:id}/like',LikeController::class)->name('like.photo');


});



require __DIR__.'/auth.php';
