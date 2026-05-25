<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomCategoryController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\RoomBrowseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('home');

// Public pages - accessible to all users
Route::get('/rooms', [RoomBrowseController::class, 'index'])->name('rooms.browse');
Route::get('/rooms/{room}', [RoomBrowseController::class, 'show'])->name('rooms.show');
Route::view('/facilities', 'user.pages.facilities')->name('facilities');
Route::view('/contact', 'user.pages.contact')->name('contact');
Route::view('/about', 'user.pages.about')->name('about');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Check-in / Check-out management pages
    Route::get('bookings/check-ins', [App\Http\Controllers\Admin\BookingController::class, 'checkins'])->name('bookings.checkins');
    Route::get('bookings/check-outs', [App\Http\Controllers\Admin\BookingController::class, 'checkouts'])->name('bookings.checkouts');
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    Route::patch('bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{booking}/process', [App\Http\Controllers\Admin\PaymentController::class, 'create'])->name('payments.process');
    Route::post('payments/{booking}', [App\Http\Controllers\Admin\PaymentController::class, 'store'])->name('payments.store');
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::resource('room-categories', RoomCategoryController::class);
    Route::delete('rooms/delete-by-type', [App\Http\Controllers\Admin\RoomController::class, 'destroyByType'])->name('rooms.destroyByType');
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/bookings', [App\Http\Controllers\Admin\UserController::class, 'bookings'])->name('users.bookings');
});

// User Routes
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserHomeController::class, 'index'])->name('dashboard');

    // Room-specific booking routes MUST come before resource to avoid {booking} capturing 'room'
    Route::get('bookings/room/{room}/create', [App\Http\Controllers\User\BookingController::class, 'create'])
        ->name('bookings.room.create');
    Route::post('bookings/room/{room}', [App\Http\Controllers\User\BookingController::class, 'store'])
        ->name('bookings.room.store');
    Route::post('bookings/{booking}/cancel', [App\Http\Controllers\User\BookingController::class, 'cancel'])
        ->name('bookings.cancel');

    Route::resource('bookings', App\Http\Controllers\User\BookingController::class);

    // Payment flow for bookings
    Route::get('bookings/{booking}/payment', [App\Http\Controllers\User\PaymentController::class, 'create'])
        ->name('bookings.payment.create');
    Route::post('bookings/{booking}/payment', [App\Http\Controllers\User\PaymentController::class, 'store'])
        ->name('bookings.payment.store');

    Route::resource('rooms', App\Http\Controllers\User\RoomController::class);
});

// Fallback dashboard route for authenticated users without proper role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user && $user->role === 'user') {
        return redirect()->route('user.dashboard');
    }

    // Default fallback
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
