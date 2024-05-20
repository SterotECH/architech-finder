<?php

namespace App\Http\Middleware;

use App\Core\Authenticator;
use App\Core\Interface\MiddlewareInterface;
use App\Core\Interface\RequestInterface;
use Closure;

class AuthMiddleware implements MiddlewareInterface
{

    public function handle(RequestInterface $request, Closure $next): void
    {
        if(!Authenticator::check()){
            header("Location: /auth/login");
            exit();
        }
        $next($request);
    }
}
