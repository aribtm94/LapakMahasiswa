<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminSellerVerificationController;
use App\Http\Controllers\SellerActivationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Seller registration (public)
Route::get('/seller/register', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/seller/register', [SellerRegistrationController::class, 'store'])->name('seller.register.store');

// Activation link
Route::get('/seller/activate/{token}', [SellerActivationController::class, 'activate'])->name('seller.activate');

// Admin seller verification (basic auth protection). Ideally add admin middleware.
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/sellers', [AdminSellerVerificationController::class, 'index'])->name('admin.sellers.index');
    Route::get('/admin/sellers/{user}', [AdminSellerVerificationController::class, 'show'])->name('admin.sellers.show');
    Route::post('/admin/sellers/{user}/approve', [AdminSellerVerificationController::class, 'approve'])->name('admin.sellers.approve');
    Route::post('/admin/sellers/{user}/reject', [AdminSellerVerificationController::class, 'reject'])->name('admin.sellers.reject');
});
