<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HargaBroadcastController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PetaniController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Konsumen\DashboardController as KonsumenDashboardController;
use App\Http\Controllers\Konsumen\OrderController as KonsumenOrderController;
use App\Http\Controllers\Konsumen\ProductController as KonsumenProductController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Petani\DashboardController as PetaniDashboardController;
use App\Http\Controllers\Petani\PenjualanController;
use App\Http\Controllers\Petani\StockController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing
Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/tentang', [LandingController::class, 'tentang'])->name('tentang');
Route::get('/produk', [LandingController::class, 'produk'])->name('produk');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->except('show');
    Route::resource('petani', PetaniController::class)->except('show');
    Route::resource('products', AdminProductController::class);

    Route::resource('harga', HargaBroadcastController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
    Route::patch('orders/{order}/cancel', [AdminOrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// Petani
Route::middleware(['auth', 'role:petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [PetaniDashboardController::class, 'index'])->name('dashboard');
    Route::get('stok', [StockController::class, 'index'])->name('stok.index');
    Route::post('stok', [StockController::class, 'store'])->name('stok.store');
    Route::get('stok/{stock}', [StockController::class, 'edit'])->name('stok.edit');
    Route::patch('stok/{stock}', [StockController::class, 'update'])->name('stok.update');
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
});

// Konsumen
Route::middleware(['auth', 'role:konsumen'])->prefix('konsumen')->name('konsumen.')->group(function () {
    Route::get('/dashboard', [KonsumenDashboardController::class, 'index'])->name('dashboard');

    Route::get('produk', [KonsumenProductController::class, 'index'])->name('products.index');
    Route::get('produk/{product}', [KonsumenProductController::class, 'show'])->name('products.show');

    Route::get('pesanan', [KonsumenOrderController::class, 'index'])->name('orders.index');
    // PENTING: route checkout ini harus didaftarkan SEBELUM 'pesanan/{order}',
    // supaya "checkout" tidak tertangkap sebagai parameter {order} (route model binding).
    Route::get('pesanan/checkout', [KonsumenOrderController::class, 'create'])->name('orders.create');
    Route::post('pesanan', [KonsumenOrderController::class, 'store'])->name('orders.store');
    Route::get('pesanan/{order}', [KonsumenOrderController::class, 'show'])->name('orders.show');
});

// Profile Role
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
