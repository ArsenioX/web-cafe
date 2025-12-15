<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;     // Pastikan ini ada
use App\Http\Controllers\TransactionController; // Pastikan ini ada
use App\Http\Controllers\CategoryController;    // Pastikan ini ada
use App\Http\Controllers\Admin\AdminTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==========================================
// 1. WILAYAH ADMIN (BOS) - Cuma Boleh Kelola Data & Laporan
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Produk (Tambah/Edit/Hapus Menu)
    Route::resource('products', ProductController::class);

    // Laporan (Hanya Melihat)
    Route::get('/transactions', [AdminTransactionController::class, 'history'])->name('admin.transactions.index');
    Route::get('reports/financial', [AdminTransactionController::class, 'financialReport'])->name('admin.reports.financial');
    Route::get('/financial-report', [AdminTransactionController::class, 'financialReport'])->name('admin.financial');
    Route::get('transaction/{id}/print', [TransactionController::class, 'printStruk'])->name('admin.transaction.print');

    Route::resource('categories', CategoryController::class);
    
   
});

// ==========================================
// 2. WILAYAH USER (KASIR) - Tempat Jualan
// ==========================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {

    // Dashboard Kasir
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('user.dashboard');

    // ✅ FITUR BELANJA HARUS DI SINI (Supaya Kasir bisa akses)
    Route::get('cart/update/{id}/{action}', [TransactionController::class, 'updateCart'])->name('cart.update');
    Route::get('cart/remove/{id}', [TransactionController::class, 'removeCart'])->name('cart.remove');
    Route::get('/add-to-cart/{id}', [TransactionController::class, 'addToCart'])->name('cart.add');
    Route::get('/clear-cart', [TransactionController::class, 'clearCart'])->name('cart.clear');

    // Checkout
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transaction.process');
    Route::get('/transaction/{id}/print', [TransactionController::class, 'printStruk'])->name('transaction.print');
});
