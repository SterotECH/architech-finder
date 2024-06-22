<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('homepage');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/projects', App\Http\Controllers\ProjectController::class)->withTrashed();

    Route::resource('projects.proposals', App\Http\Controllers\ProposalController::class);

    Route::group(['prefix' => '/projects/{slug}'], function () {
        Route::post('/accept',  [App\Http\Controllers\ProposalController::class, 'acceptProposal'])
        ->name('proposals.accept');
    });

    Route::resource('/architects', App\Http\Controllers\ArchitectController::class);

    Route::resource('/messages', App\Http\Controllers\MessageController::class)->only(['index', 'destroy']);
    Route::get('/message/{project}', [App\Http\Controllers\MessageController::class, 'create'])->name('messages.chat');
});
