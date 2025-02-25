<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'Store']);
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
// Frontend Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/frontend/cars', [App\Http\Controllers\Frontend\CarController::class, 'index'])->name('frontend.cars.index');

Route::put('admin/customers/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');



// Admin Routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
	Route::get('/info', [DashboardController::class, 'info'])->name('info');
    Route::resource('cars', CarController::class);
    Route::resource('rentals', RentalController::class);
    Route::resource('customers', CustomerController::class);
	
});


// User Bookings
Route::middleware('auth')->group(function () {
	
    Route::get('/my-bookings', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/my-bookings/{rental}', [RentalController::class, 'show'])->name('rentals.show');
    Route::post('/cancel-booking/{rental}', [RentalController::class, 'cancel'])->name('rentals.cancel');
	Route::get('/frontend/cars/{car}', [App\Http\Controllers\Frontend\CarController::class, 'show'])->name('frontend.cars.show');	
	
   //Display all rentals
    Route::get('/frontend/rentals', [App\Http\Controllers\Frontend\RentalController::class, 'index'])->name('frontend.rentals.index');
	Route::post('/frontend/rentals/{car}', [App\Http\Controllers\Frontend\RentalController::class, 'store'])->name('frontend.rentals.store');
    //Store a new rental
    Route::get('/frontend/rentals/{car}', [App\Http\Controllers\Frontend\RentalController::class, 'store'])->name('frontend.rentals.store');
	
	Route::get('users/{user}/edit', [RegisteredUserController::class, 'edit'])->name('users.edit');

	// Route to handle the update action
	Route::put('users/{user}', [RegisteredUserController::class, 'update'])->name('users.update');	
	
	
});


// Logout
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');




