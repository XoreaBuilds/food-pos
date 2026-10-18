<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Livewire\MenuManagement;
use App\Livewire\ReportsPage;
use App\Livewire\UserManagement;

Route::middleware(['auth', 'permission:manage menu'])->get('/menu', MenuManagement::class)->name('menu.index');
Route::middleware(['auth', 'permission:view reports'])->get('/reports', ReportsPage::class)->name('reports');
Route::middleware(['auth', 'permission:manage users'])->get('/users', UserManagement::class)->name('users.index');

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
