<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

Route::get('song/getList', [SongController::class, 'getList'])->name('song.getList');
Route::resource('song', SongController::class);





