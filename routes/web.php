<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::middleware(['auth'])->group(function () {
    // Projects Routes
    Route::resource('projects', ProjectController::class);
    
    // Tasks Routes
    Route::resource('tasks', TaskController::class);
    
    // Comments Routes
    Route::resource('comments', CommentController::class)->except(['create']);
    Route::get('/tasks/{task}/comments/create', [CommentController::class, 'create'])
         ->name('comments.create');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';