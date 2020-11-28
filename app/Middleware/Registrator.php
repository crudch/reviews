<?php

namespace App\Middleware;

use System\Middleware\SessionMiddleware;
use System\Middleware\CheckCsrfMiddleware;

/**
 * Class Registrator
 *
 * @package App\Middleware
 */
class Registrator
{
    /**
     * @var array
     */
    public static array $registry = [
        'global' => [
            SessionMiddleware::class,
            CheckCsrfMiddleware::class
        ],
        'web' => [],
        'api' => [],
    ];

    /**
     * @var array
     */
    public static array $middleware = [

    ];
}
