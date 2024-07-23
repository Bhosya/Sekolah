<?php

use App\Http\Controllers\AllController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::get('siswa/filter', [SiswaController::class, 'filter'])->name('siswa.filter');

    Route::resource('guru', GuruController::class);
    Route::get('/guru/filter', [GuruController::class, 'filter'])->name('guru.filter');

    Route::resource('kelas', KelasController::class);

    Route::get('/all', [AllController::class, 'index']) -> name('all');
});