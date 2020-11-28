<?php

namespace App\Middleware;

use System\Http\Request;
use System\Http\Response;
use System\Middleware\MiddlewareInterface;
use System\Http\Exceptions\ForbiddenException;

/**
 * Class AuthMiddleware
 *
 * @package App\Middleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param callable $next
     *
     * @return Response
     * @throws ForbiddenException
     */
    public function handle(Request $request, callable $next)
    {
        if (user()->isGuest()) {
            throw new ForbiddenException('Только для зарегистрированных пользователей');
        }

        return $next($request);
    }
}
