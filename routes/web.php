<?php

use App\Core\Router;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GustMiddleware;

Router::get('/', [HomeController::class , 'index']);
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
Router::resource('/users',UserController::class);
Router::resource('/client', App\Http\Controllers\ClientController::class);
Router::resource('/architect', App\Http\Controllers\ArchitectController::class);
Router::resource('/projects', App\Http\Controllers\ProjectController::class, [AuthMiddleware::class]);
Router::group(['prefix'=>'/projects/{slug}'], function (){
  Router::resource('/proposals', App\Http\Controllers\ProposalController::class, [AuthMiddleware::class]);
});
Router::post('/proposal/accept', [App\Http\Controllers\ProposalController::class, 'accept'])->middleware([AuthMiddleware::class]);
