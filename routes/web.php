<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CongeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Tables
Route::get('tables', [CongeController::class, 'showTables'])
    ->name('tables')
    ->middleware('auth');

// Congés
Route::middleware('auth')->group(function () {
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::post('/conges/{id}/status', [CongeController::class, 'updateStatus'])->name('conges.updateStatus');
});


// Dashboard - Inspecteur
Route::get('/dashboard/inspecteur', [DashboardController::class, 'dashboardInspecteur'])
    ->middleware('role:inspecteur')
    ->name('dashboard.inspecteur');

Route::post('/conge/store', [CongeController::class, 'store'])->name('conge.store');

Route::get('/dashboard/inspecteur/avancement', [DashboardController::class, 'inspecteurAvancement'])
    ->middleware('role:inspecteur')
    ->name('dashboard.inspecteur.avancement');

Route::middleware(['auth:inspecteur'])->group(function() {
    Route::get('/dashboard/inspecteur/conge', [CongeController::class, 'create'])
        ->name('dashboard.inspecteur.conge');
});




// Dashboard - Directeur
Route::get('/dashboard/directeur', [DashboardController::class, 'directeurDashboard'])
    ->middleware(['auth', 'role:directeur'])
    ->name('dashboard.directeur');

// Missions actions
Route::post('/mission/{id}/avancer', [DashboardController::class, 'incrementJours'])->name('mission.avancer.jour');
Route::get('/mission/{id}/rapport-pdf', [DashboardController::class, 'downloadRapport'])->name('mission.rapport.pdf');

Route::middleware(['auth', 'role:coordinateur'])->group(function () {
    Route::get('/dashboard/coordinateur', [DashboardController::class, 'coordinateurDashboard'])->name('dashboard.coordinateur');
    Route::get('/dashboard/coordinateur/inspecteur', [DashboardController::class, 'showInspecteurs'])->name('dashboard.coordinateur.inspecteur');
});

Route::post('/dashboard/coordinateur/inspecteur', [DashboardController::class, 'storeInspecteur'])
    ->name('inspecteurs.store');

Route::put('/dashboard/coordinateur/inspecteur/{id}', [DashboardController::class, 'updateInspecteur'])
    ->name('inspecteurs.update');

Route::delete('/dashboard/coordinateur/inspecteur/{id}', [DashboardController::class, 'destroyInspecteur'])
    ->name('inspecteurs.destroy');


Route::middleware(['auth', 'role:inspecteur'])->group(function () {
    Route::post('/missions/{id}/accepter', [DashboardController::class, 'accepter'])->name('missions.accepter');
    Route::post('/missions/{id}/refuser', [DashboardController::class, 'refuser'])->name('missions.refuser');
});

// Missions CRUD
Route::middleware(['auth'])->group(function () {
    Route::get('/missions', [DashboardController::class, 'index'])->name('missions.index');
    Route::post('/missions', [DashboardController::class, 'store'])->name('missions.store');
    Route::put('/missions/{id}', [DashboardController::class, 'update'])->name('missions.update');
    Route::delete('/missions/{id}', [DashboardController::class, 'destroy'])->name('missions.destroy');

    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('billing', fn() => view('billing'))->name('billing');
    Route::get('profile', fn() => view('profile'))->name('profile');
    Route::get('rtl', fn() => view('rtl'))->name('rtl');

    Route::get('rapports', [DashboardController::class, 'rapports'])->name('rapports');
    Route::get('/rapports/search', [DashboardController::class, 'search'])->name('rapports.search');

    Route::get('virtual-reality', fn() => view('virtual-reality'))->name('virtual-reality');
    Route::get('static-sign-in', fn() => view('static-sign-in'))->name('sign-in');
    Route::get('static-sign-up', fn() => view('static-sign-up'))->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/login', fn() => view('dashboard'))->name('sign-up');
});

// Auth
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/session', [SessionsController::class, 'store']);
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Fallback login view
Route::get('/login', fn() => view('session/login-session'))->name('login');
Route::get('/missions', [DashboardController::class, 'index'])->name('missions');

Route::put('/conges/{id}/status', [CongeController::class, 'updateStatus'])->name('conges.updateStatus');


Route::middleware(['auth:inspecteur'])->group(function() {
    Route::get('/dashboard/inspecteur', [DashboardController::class, 'dashboardInspecteur'])->name('dashboard.inspecteur');
    Route::get('/dashboard/inspecteur/avancement', [DashboardController::class, 'inspecteurAvancement'])->name('dashboard.inspecteur.avancement');
});

