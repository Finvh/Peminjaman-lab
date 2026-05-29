 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

// Halaman Landing
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Mahasiswa)
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/barang', [UserController::class, 'barang'])->name('barang');
    Route::get('/booking/create', [UserController::class, 'createBooking'])->name('booking.create');
    Route::post('/booking', [UserController::class, 'storeBooking'])->name('booking.store');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
   

    // Barang Management
    Route::get('/barang', [AdminController::class, 'barang'])->name('barang');
    Route::post('/barang', [AdminController::class, 'storeBarang'])->name('barang.store');
    Route::put('/barang/{id}', [AdminController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'deleteBarang'])->name('barang.delete');

    // Update Status Peminjaman
    Route::put('/peminjaman/{id}/status', [AdminController::class, 'updateStatus'])->name('peminjaman.status');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::delete('/users/delete/{id}', [AdminUserController::class, 'destroy'])->name('users.delete');
});
require __DIR__.'/auth.php';
