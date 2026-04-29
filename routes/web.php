<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('sales-pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('sales-pages', SalesPageController::class);
    Route::post('/sales-pages/{salesPage}/regenerate-section', [SalesPageController::class, 'regenerateSection'])
        ->name('sales-pages.regenerate-section');
    Route::get('/sales-pages/{salesPage}/export', [SalesPageController::class, 'exportHtml'])
        ->name('sales-pages.export');
});

require __DIR__.'/auth.php';
