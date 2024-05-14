<?php
declare(strict_types=1);

$minPhpVersion = '7.4';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run Stero MVC. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    exit($message);
}

use App\Core\Response;
use App\Core\Router;
use App\Core\Session;
use Dotenv\Dotenv;

const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'app/Core/utils.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

require base_path('routes/web.php');


try {
    Router::executeRoutes();
} catch (PDOException $exception){
    abort(Response::HTTP_INTERNAL_SERVER_ERROR, description: $exception, view: 'status/sql');
} catch (Exception $e) {
    dd($e->getMessage());
}

Session::unflash();
