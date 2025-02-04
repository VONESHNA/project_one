<?php
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\MyController;

use Illuminate\Support\Facades\Route;
Route::post('/audio/duration', [AudioController::class, 'getAudioDuration']);
Route::get('audio', function(){return view('audio.index');})->name('audio');
Route::get('distance', function(){return view('distance.index');})->name('distance');
Route::post('/calculate-distance', [DistanceController::class, 'calculateDistance']);
Route::resource('dashboard', MyController::class)->middleware('auth');
Route::get('edit', [MyController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::put('update', [MyController::class, 'update'])->middleware('auth')->name('user.update');
Route::get('update', [MyController::class, 'index'])->middleware('auth')->name('updated.user');
Route::post('store', [MyController::class, 'store'])->name('user.store');

Route::get('adduser', [MyController::class, 'create']);
Route::get('/login', function () {return view('users.login');})->name('login');    
Route::post('/checklogin', [MyController::class, 'login'])->name('users.checklogin');
Route::post('/logout', [MyController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/myview', function () {
    return view('myview');
});

