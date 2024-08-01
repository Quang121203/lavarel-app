<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

Route::resource('song', SongController::class);
Route::get('songs/getList', [SongController::class, 'getList'])->name('song.getList');



