<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesPageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// One-time migration endpoint — protected by secret token
Route::get('/run-migrations', function () {
    $secret = config('app.migrate_secret', '');
    if (empty($secret) || request('token') !== $secret) {
        abort(403, 'Forbidden');
    }
    Artisan::call('migrate', ['--force' => true]);
    return '<pre>' . Artisan::output() . '</pre>';
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
