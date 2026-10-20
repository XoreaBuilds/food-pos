<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Livewire\MenuManagement;
use App\Livewire\ReportsPage;
use App\Livewire\UserManagement;
use App\Livewire\PosRegister;
use App\Livewire\PaymentPage;
use App\Livewire\OrderStatus;

Route::middleware(['auth', 'permission:manage menu'])->get('/menu', MenuManagement::class)->name('menu.index');
Route::middleware(['auth', 'permission:view reports'])->get('/reports', ReportsPage::class)->name('reports');
Route::middleware(['auth', 'permission:manage users'])->get('/users', UserManagement::class)->name('users.index');

// routes/web.php
Route::middleware(['auth', 'permission:access pos'])->get('/pos', PosRegister::class)->name('pos');
Route::middleware(['auth', 'permission:process payments'])->get('/payment', PaymentPage::class)->name('payment');
Route::middleware(['auth', 'permission:view order status'])->get('/orders', OrderStatus::class)->name('orders.status');
Route::middleware(['auth', 'permission:view kitchen display'])->get('/kitchen', OrderStatus::class)->name('kitchen.display');
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
