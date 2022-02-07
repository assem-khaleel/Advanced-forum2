<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('discussion/{slug}',[\App\Http\Controllers\DiscussionsController::class,'show'])->name('discussion');
Route::get('channel/{slug}',[\App\Http\Controllers\ForumsController::class,'channel'])->name('channel');


Auth::routes();

Route::get('/forum', [\App\Http\Controllers\ForumsController::class, 'index'])->name('forum');
Route::group(['middleware'=>'auth'],function (){
 Route::resource('channels',\App\Http\Controllers\ChannelsController::class);
 Route::get('discussion/create/new',[\App\Http\Controllers\DiscussionsController::class,'create'])->name('discussion.create');
 Route::post('discussion/store',[\App\Http\Controllers\DiscussionsController::class,'store'])->name('discussion.store');
 Route::post('discussion/reply/{id}',[\App\Http\Controllers\DiscussionsController::class,'reply'])->name('discussion.reply');
 Route::get('reply/like/{id}',[\App\Http\Controllers\RepliesController::class,'like'])->name('reply.like');
 Route::get('reply/unlike/{id}',[\App\Http\Controllers\RepliesController::class,'unlike'])->name('reply.unlike');
 Route::get('discussion/watch/{id}',[\App\Http\Controllers\WatchersController::class,'watch'])->name('discussion.watch');
 Route::get('discussion/unwatch/{id}',[\App\Http\Controllers\WatchersController::class,'unwatch'])->name('discussion.unwatch');
 Route::get('discussion/best/reply/{id}',[\App\Http\Controllers\RepliesController::class,'best_answer'])->name('discussion.best.answer');
 Route::get('discussion/edit/{slug}',[\App\Http\Controllers\DiscussionsController::class,'edit'])->name('discussion.edit');
 Route::post('discussion/update/{id}',[\App\Http\Controllers\DiscussionsController::class,'update'])->name('discussion.update');
 Route::get('reply/edit/{id}',[\App\Http\Controllers\RepliesController::class,'edit'])->name('reply.edit');
 Route::post('reply/update/{id}',[\App\Http\Controllers\RepliesController::class,'update'])->name('reply.update');
});
