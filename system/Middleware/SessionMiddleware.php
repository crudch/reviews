<?php

namespace System\Middleware;

use System\Http\Request;
use System\Http\Response;

/**
 * Class SessionMiddleware
 *
 * @package System\Middleware
 */
class SessionMiddleware implements MiddlewareInterface
{

    /**
     * @param Request $request
     * @param callable $next
     *
     * @return mixed
     */
    public function handle(Request $request, callable $next)
    {
        session_start();

        if (!empty($request->cookie('X-Key'))) {
            return $next($request);
        }

        $key = $_SESSION['X-Key'] ?? $_SESSION['X-Key'] = randomString();

        /** @var Response $response */
        $response = $next($request);

        return $response->withCookie(['X-Key' => $key]);
    }
}
