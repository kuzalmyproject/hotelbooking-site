<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IndexController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
   Route::get('/password/reset/view','PasswordResetView')->name('password.reset.view');
   Route::post('/password/reset','PasswordResetEmail')->name('password.reset.email');


});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile/view', [AdminController::class, 'adminProfileView']);
    Route::get('/admin/profile/edit', [AdminController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::patch('/admin/profile/update/{id}', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/password/change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::put('/admin/password/update', [AdminController::class, 'adminPasswordupdate'])->name('admin.password.update');

    
});
require __DIR__.'/auth.php';
