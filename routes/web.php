<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Auth\CardLoginController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\RideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes for public pages, user dashboard, admin panel, and card login.
|
*/

Route::get('/', fn () => view('welcome'))->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ride routes
    Route::get('/my-cards/{card}/rides/create', [RideController::class, 'create'])->name('user.rides.create');
    Route::post('/my-cards/{card}/rides', [RideController::class, 'store'])->name('user.rides.store');

    // User cards CRUD
    Route::get('/my-cards', [CardController::class, 'index'])->name('user.cards.index');
    Route::get('/my-cards/create', [CardController::class, 'create'])->name('user.cards.create');
    Route::post('/my-cards', [CardController::class, 'store'])->name('user.cards.store');
    Route::get('/my-cards/{card}', [CardController::class, 'show'])->name('user.cards.show');
    Route::delete('/my-cards/{card}', [CardController::class, 'destroy'])->name('user.cards.destroy');

    Route::post('/my-cards/{card}/recharges', [CardController::class, 'storeRecharge'])->name('user.cards.recharges.store');
    Route::post('/my-cards/{card}/rides', [CardController::class, 'storeRide'])->name('user.cards.rides.store');

    Route::get('/get-ticket-types/{city}', [CardController::class, 'getTicketTypesByCity'])->name('user.ticketTypes.byCity');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('cities', CityController::class);
        Route::resource('ticket-types', TicketTypeController::class);
    });

Route::get('/login-card', [CardLoginController::class, 'showLoginForm'])
    ->name('auth.card.form');

Route::post('/login-card', [CardLoginController::class, 'login'])
    ->name('auth.card.login');

// legacy deletion route present in project
Route::delete('/user/cards/{card}', [App\Http\Controllers\User\CardController::class, 'destroy'])
    ->name('user.cards.destroy');
