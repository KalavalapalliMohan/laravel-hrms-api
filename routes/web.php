<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware(['auth', 'role:Admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return 'Admin Dashboard';
//     });
// });

// admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');
});
// hr
Route::middleware(['auth', 'role:HR'])->group(function () {
    Route::get('/hr/dashboard', [DashboardController::class, 'hr'])
        ->name('hr.dashboard');
});

// admin or hr
Route::middleware(['auth', 'role:Admin,HR'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});








require __DIR__.'/auth.php';
