<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AntavayaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\RekonController;
use App\Http\Controllers\BaRekonsiliasiController;
use App\Http\Controllers\GrabBagController;

// REGISTER
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// FORGOT PASSWORD
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
    
    // Tambahkan route yang membutuhkan auth di sini
});

// Route untuk lupa password (opsional)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Route untuk register (opsional)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// BAG DAILY
Route::get('/bag', [BagController::class, 'index'])->name('bag.index');

Route::get('/bag/upload', function () {
    return view('bag.upload');
})->name('bag.upload.form');

Route::post('/bag/upload', [UploadController::class, 'uploadBag'])->name('bag.upload');

// ANTAVAYA
Route::get('/antavaya', [AntavayaController::class, 'index'])->name('antavaya.index');
Route::get('/antavaya/data', [AntavayaController::class, 'data'])->name('antavaya.data');

Route::get('/antavaya/export', [AntavayaController::class, 'export'])->name('antavaya.export');

Route::get('/antavaya/upload', function () {
    return view('antavaya.upload');
})->name('antavaya.upload.form');

Route::post('/antavaya/upload', [UploadController::class, 'uploadAntavaya'])->name('antavaya.upload');

// GRAB BAg
Route::get('/grab_bag', [GrabBagController::class, 'index'])
    ->name('grab_bag.index');

Route::any('/grab_bag/data', [GrabBagController::class, 'data'])
    ->name('grab_bag.data');

Route::get('/grab_bag/upload', function () {
    return view('grab_bag.upload');
})->name('grab_bag.upload.form');

Route::post('/grab_bag/upload', [UploadController::class, 'uploadGrabBag'])
    ->name('grab_bag.upload');

Route::get('/grab_bag/progress', [UploadController::class, 'grabBagProgress'])
    ->name('grab_bag.progress');

//LPP PDF
Route::get('/lpp', [PdfController::class, 'index'])->name('lpp.index');
Route::post('/lpp/upload', [PdfController::class, 'upload'])->name('lpp.upload');
Route::get('/lpp/download/{id}', [PdfController::class, 'download'])->name('lpp.download');

// Rekon
Route::get('/rekon', [RekonController::class, 'index'])->name('rekon.index');
Route::post('/rekon/process', [RekonController::class, 'process'])->name('rekon.process');
Route::get('/rekon/download', [RekonController::class, 'downloadExcel'])->name('rekon.download');

//BA Rekon
Route::prefix('ba-rekonsiliasi')->group(function () {
    Route::get('/', [BaRekonsiliasiController::class, 'index'])->name('ba-rekonsiliasi.index');
    Route::get('/create', [BaRekonsiliasiController::class, 'create'])->name('ba-rekonsiliasi.create');
    Route::post('/', [BaRekonsiliasiController::class, 'store'])->name('ba-rekonsiliasi.store');
    Route::get('/{id}', [BaRekonsiliasiController::class, 'show'])->name('ba-rekonsiliasi.show');
    Route::get('/ba-rekonsiliasi/{id}/preview', [BaRekonsiliasiController::class, 'previewPdf'])->name('ba-rekonsiliasi.preview');
    Route::get('/{id}/download-pdf', [BaRekonsiliasiController::class, 'downloadPdf'])->name('ba-rekonsiliasi.download-pdf');
    Route::get('/{id}/download-word', [BaRekonsiliasiController::class, 'downloadWord'])->name('ba-rekonsiliasi.download-word');
});