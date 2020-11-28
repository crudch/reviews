<?php

namespace App\Exceptions;

use Throwable;
use System\Routing\RouteException;
use System\Http\Exceptions\NotFoundException;
use System\Http\Exceptions\ForbiddenException;
use System\Middleware\Handlers\WebExceptionsMiddleware as ExceptionsMiddleware;

class WebExceptionsMiddleware extends ExceptionsMiddleware
{
    /**
     * @param Throwable $e
     *
     * @return mixed
     */
    protected function generateError(Throwable $e)
    {
        if ($e instanceof RouteException) {

        }

        if ($e instanceof NotFoundException) {

        }

        if ($e instanceof ForbiddenException) {

        }

        return parent::generateError($e);
    }
}
