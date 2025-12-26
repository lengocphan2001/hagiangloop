<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestNews = App\Models\News::published()
        ->orderBy('sort_order')
        ->orderBy('published_at', 'desc')
        ->limit(3)
        ->get();
    
    return view('home', compact('latestNews'));
})->name('home');

// Page routes
Route::get('/page/{slug}', [App\Http\Controllers\PageController::class, 'show'])->name('page.show');

// Tour routes
Route::get('/tours', [App\Http\Controllers\TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{slug}', [App\Http\Controllers\TourController::class, 'show'])->name('tours.show');

// News routes
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

// Auth routes (sẽ được implement sau)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Admin Auth routes (no auth middleware)
Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminAuthController::class, 'login']);
    Route::match(['get', 'post'], '/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin routes (require auth)
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    
    // Pages management
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
    
    // Tours management
    Route::resource('tours', App\Http\Controllers\Admin\TourController::class);
    
    // News management
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    
    // Image upload for TinyMCE
    Route::post('/upload-image', [App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload-image');
});

// Legacy dashboard route (redirect to admin)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard')->middleware('auth');
