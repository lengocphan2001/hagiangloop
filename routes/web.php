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

// Gallery routes
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Checkout routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{id}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

// API routes
Route::prefix('api')->group(function () {
    Route::get('/gifts', [App\Http\Controllers\Api\GiftController::class, 'index'])->name('api.gifts');
    Route::get('/bus-services', [App\Http\Controllers\Api\BusServiceController::class, 'index'])->name('api.bus-services');
    Route::get('/bus-services/starting-points', [App\Http\Controllers\Api\BusServiceController::class, 'getStartingPoints'])->name('api.bus-services.starting-points');
    Route::get('/bus-services/return-destinations', [App\Http\Controllers\Api\BusServiceController::class, 'getReturnDestinations'])->name('api.bus-services.return-destinations');
});

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
    
    // Gifts management
    Route::resource('gifts', App\Http\Controllers\Admin\GiftController::class);
    
    // Bus Services management
    Route::resource('bus-services', App\Http\Controllers\Admin\BusServiceController::class);
    
    // Image upload for TinyMCE
    Route::post('/upload-image', [App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload-image');
});

// Legacy dashboard route (redirect to admin)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard')->middleware('auth');
