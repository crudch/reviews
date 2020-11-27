<?php

namespace System\Middleware;

use RuntimeException;
use System\Http\Request;
use System\Routing\Route;
use System\Routing\Router;
use App\Middleware\Registrator;
use System\Routing\RouteException;

/**
 * Class RouteMiddleware
 *
 * @package System\Middleware
 */
class RouteMiddleware implements MiddlewareInterface
{
    /**
     * @var string
     */
    protected string $mode;

    /**
     * RouteMiddleware constructor.
     *
     * @param string $mode
     */
    public function __construct(string $mode)
    {
        $this->mode = $mode;
    }

    /**
     * @param Request  $request
     * @param callable $next
     *
     * @return mixed
     * @throws RouteException
     */
    public function handle(Request $request, callable $next)
    {
        /** @var Route $route */
        [$route, $attributes] = Router::load(root_path("/routes/{$this->mode}.php"))->match();
        $request->setAttributes($attributes);

        $pipline = new Pipline();

        foreach (array_merge(Registrator::$registry['global'], Registrator::$registry[$this->mode]) as $middleware) {
            $pipline->pipe($middleware);
        }

        foreach ($route->getMiddleware() as $name) {
            if (!isset(Registrator::$middleware[$name])) {
                throw new RuntimeException("Middleware [ {$name} ] не существует.");
            }

            $pipline->pipe(Registrator::$middleware[$name]);
        }

        $pipline->pipe(static fn() => new ControllerMiddleware(... $route->getHandler()));

        return $pipline->run($request);
    }
}
