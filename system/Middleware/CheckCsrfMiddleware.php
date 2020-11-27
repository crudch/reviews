<?php

namespace System\Middleware;

use System\Http\Request;
use InvalidArgumentException;
use System\Http\Exceptions\MultiException;

/**
 * Class CheckCsrfMiddleware
 *
 * @package System\Middleware
 */
class CheckCsrfMiddleware implements MiddlewareInterface
{

    /**
     * @param Request $request
     * @param callable $next
     *
     * @return mixed
     * @throws MultiException
     */
    public function handle(Request $request, callable $next)
    {
        if ($request->type() === 'POST') {
            $key = $request->input('csrf_key') ?? $request->headers('X-Key');

            if (empty($key) || !is_string($key) || $key !== csrfKey()) {
                $multi = new MultiException();
                $multi->add('csrf_key', new InvalidArgumentException('CSRF token mismatch'));

                throw $multi;
            }

            $request->deleteAttribute('csrf_key', 'post');
        }

        return $next($request);
    }
}
