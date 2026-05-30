<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MapController;
use Livewire\Volt\Volt;

Route::get('/', function () {
    // check if user is logged in
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
})->name('index');


Volt::route('/updates', 'pages.release-notes.index')->name('updates');
Volt::route('/updates/{slug}', 'pages.release-notes.view')->name('update.view');

Volt::route('/vote', 'pages.vote.index')->name('vote');
Volt::route('/vote/{slug}', 'pages.vote.view')->name('vote.view');

Volt::route('/connections', 'pages.connections.index')->name('connections');

Volt::route('/characters', 'pages.characters.index')
    ->middleware(['auth'])
    ->name('characters');

Volt::route('/characters/{id}', 'pages.characters.show')
    ->middleware(['auth'])
    ->name('characters.show');

Volt::route('/vehicles', 'pages.vehicles.index')
    ->middleware(['auth'])
    ->name('vehicles');

Volt::route('/properties', 'pages.properties.index')
    ->middleware(['auth'])
    ->name('properties');

Volt::route('/bancheck', 'pages.bancheck.index')
    ->middleware(['auth'])
    ->name('bancheck');

Volt::route('/marketplace', 'pages.marketplace.index')
    ->middleware(['auth'])
    ->name('marketplace');

Volt::route('/premium', 'pages.premium.index')
    ->middleware(['auth'])
    ->name('premium');

Volt::route('/help', 'pages.help.index')
    ->middleware(['auth'])
    ->name('help');

// Character creation disabled - SA-MP uses single character per account
// Volt::route('/characters/create', 'pages.characters.create')->name('characters.create');
//Volt::route('/characters/{}', 'pages.release-notes.view')->name('update.view');

Route::get('dashboard', [IndexController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

Volt::route('/account', 'profile')
    ->middleware(['auth'])
    ->name('account');

Volt::route('/adminrecord', 'pages.adminrecord.index')
    ->middleware(['auth'])
    ->name('adminrecord');

Route::get('/map', [MapController::class, 'index'])->name('map');

Route::get('/api/server-status', function () {
    try {
        $count = \App\Helpers\SampQueryAPI::getServerPlayerCount();
        return response()->json(['online' => $count, 'status' => $count >= 0]);
    } catch (\Throwable $e) {
        return response()->json(['online' => -1, 'status' => false]);
    }
})->name('api.server-status')->withoutMiddleware([\Illuminate\Session\Middleware\StartSession::class, \Illuminate\Cookie\Middleware\EncryptCookies::class, \Illuminate\View\Middleware\ShareErrorsFromSession::class, \App\Http\Middleware\VerifyCsrfToken::class]);

require __DIR__.'/auth.php';
