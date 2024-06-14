<?php

<<<<<<< HEAD
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
=======
use App\Core\Request;
use App\Core\Router;
use App\Core\SSE;
use App\Models\Message;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GustMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SSEController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/auth/login', [HomeController::class, 'render_login'])->middleware([GustMiddleware::class]);
Router::get('/dashboard', [HomeController::class, 'dashboard'])
  ->middleware([AuthMiddleware::class]);
Router::post('/auth/login', [HomeController::class, 'login'])->middleware([GustMiddleware::class]);
Router::get('/auth/register', [HomeController::class, 'render_register'])->middleware([GustMiddleware::class]);
Router::post('/auth/register', [HomeController::class, 'register'])->middleware([GustMiddleware::class]);
Router::delete('/auth/logout', [HomeController::class, 'logout'])->middleware([AuthMiddleware::class]);
Router::get('/auth/forgot-password', [HomeController::class, 'render_forgot_password'])->middleware([GustMiddleware::class]);
Router::post('/auth/forgot-password', [HomeController::class, 'sendResetLink'])->middleware([GustMiddleware::class]);
Router::get('/auth/reset-password/{token}', [HomeController::class, 'renderResetPassword'])->middleware([GustMiddleware::class]);
Router::post('/auth/reset-password/{token}', [HomeController::class, 'resetPassword'])->middleware([GustMiddleware::class]);
Router::get('/about-us', [HomeController::class, 'aboutUs']);
Router::get('/contact', [HomeController::class, 'contact']);
Router::resource('/users', UserController::class);
Router::resource('/client', App\Http\Controllers\ClientController::class);
Router::resource('/architect', App\Http\Controllers\ArchitectController::class);
Router::resource('/projects', App\Http\Controllers\ProjectController::class, [AuthMiddleware::class]);
Router::group(['prefix' => '/projects/{slug}'], function () {
  Router::resource('/proposals', App\Http\Controllers\ProposalController::class, [AuthMiddleware::class]);
});
Router::post('/proposal/accept', [App\Http\Controllers\ProposalController::class, 'accept'])
  ->middleware([AuthMiddleware::class]);

Router::get('/messages', [MessageController::class, 'index'])->middleware([AuthMiddleware::class]);
Router::get('/messages/{slug}', [MessageController::class, 'edit'])->middleware([AuthMiddleware::class]);
Router::get('/sse/stream', [SSEController::class, 'stream'])->middleware([AuthMiddleware::class]);
Router::post('/sse/send-message', [SSEController::class, 'sendMessage'])->middleware([AuthMiddleware::class]);
Router::post('/sse/upload-file', [SSEController::class, 'uploadFile'])->middleware([AuthMiddleware::class]);
Router::get('/api/projects/{projectId}/messages', [SSEController::class, 'getMessages'])->middleware([AuthMiddleware::class]);
>>>>>>> origin/main
