<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

<<<<<<< HEAD
// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';
=======
use Dotenv\Dotenv;
use App\Core\Router;
use App\Models\User;
use App\Core\Session;
use App\Core\Response;
use App\Core\Authenticator;
>>>>>>> origin/main

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
