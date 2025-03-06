<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/keluar', [LoginController::class, 'keluar'])->name('login.keluar');

Route::resource('users', UserController::class);
Route::resource('mobils', MobilController::class);

Route::resource('transaksi', TransaksiController::class);
Route::post('/transaksi/hitung-total', [TransaksiController::class, 'hitungTotal']);
Route::post('/transaksi/{id}/hitung-denda', [TransaksiController::class, 'hitungDenda'])->name('transaksi.hitung-denda');





