<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RiviewController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

// Halaman Home (Bisa diakses oleh semua role setelah login)
Route::get('admin/home', [AdminHomeController::class, 'index'])->name('admin.home')->middleware('auth');


// Autentikasi
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/keluar', [LoginController::class, 'keluar'])->name('admin.login.keluar');

// ✅ ROUTE UNTUK ADMIN (Bisa Akses: Home, Mobil, User, dan Transaksi)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/mobils', MobilController::class);
    Route::resource('admin/transaksi', TransaksiController::class);
    Route::post('admin/transaksi/hitung-total', [TransaksiController::class, 'hitungTotal']);
    Route::post('admin/transaksi/{id}/hitung-denda', [TransaksiController::class, 'hitungDenda'])->name('transaksi.hitung-denda');
    Route::get('admin/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('admin/transaksi/{id}/invoice', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
    Route::get('admin/transaksi/{id}/invoice/pdf', [TransaksiController::class, 'cetakInvoice'])->name('transaksi.cetakInvoice');

    Route::get('admin/pesan', [ContactController::class, 'adminIndex'])->name('admin.contact.index');
    Route::delete('admin/pesan/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');


});

// ✅ ROUTE UNTUK PEMILIK (Bisa Akses: Home dan Laporan Transaksi)
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::resource('admin/users', UserController::class);
    Route::get('admin/ulasan', [ReviewController::class, 'adminIndex'])->name('admin.review.index');
    Route::patch('admin/ulasan/{id}/publish', [ReviewController::class, 'publish'])->name('admin.review.publish');
    Route::patch('admin/ulasan/{id}/unpublish', [ReviewController::class, 'unpublish'])->name('admin.review.unpublish');
    Route::delete('admin/ulasan/{id}', [ReviewController::class, 'destroy'])->name('admin.review.destroy');

    Route::get('admin/laporan/transaksi', [LaporanController::class, 'index'])->name('laporan.transaksi');
    Route::get('admin/laporan-transaksi/pdf', [LaporanController::class, 'downloadPDF'])->name('laporan.transaksi.pdf');
    Route::get('admin/laporan/{transaksi}', [LaporanController::class, 'show'])->name('laporan.show');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('sewa-mobil', [CarsController::class, 'index'])->name('cars');
Route::get('sewa-mobil/{id}', [CarsController::class, 'show'])->name('cars.show');
Route::get('kontak', [ContactController::class, 'index'])->name('contact');
Route::post('kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('ulasan', [ReviewController::class, 'index'])->name('review');
Route::post('ulasan', [ReviewController::class, 'store'])->name('review.store');

