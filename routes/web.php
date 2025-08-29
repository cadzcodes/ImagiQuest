<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ImageGenerationController;
use App\Http\Controllers\ReverseImageSearchController;

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



Route::get('/reverse-image', [ReverseImageSearchController::class, 'showForm'])->name('reverse.form');
Route::post('/reverse-image', [ReverseImageSearchController::class, 'reverseSearch'])->name('reverse.search');


Route::get('/dashboard', [ImageGenerationController::class, 'showDashboard'])->name('dashboard');


Route::delete('/image/{imageId}/delete', [ImageGenerationController::class, 'deleteImage'])
    ->name('delete.image');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Remove the duplicate route and keep the correct ones
Route::get('/image-generation', [ImageGenerationController::class, 'showForm'])->name('image.generation');
Route::post('/generate-image', [ImageGenerationController::class, 'generateImage'])->name('generate.image');
Route::post('/save-image', [ImageGenerationController::class, 'saveImage'])->name('save.image');
Route::get('/user-gallery', [ImageGenerationController::class, 'showGallery'])->name('user.gallery');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
