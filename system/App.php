<?php

namespace System;

use System\Http\Request;
use System\Middleware\Pipline;
use System\Container\Container;
use System\Middleware\RouteMiddleware;

class App extends Container
{
    /**
     * @var string
     */
    protected string $mode;

    /**
     * @var Pipline
     */
    protected Pipline $pipline;

    /**
     * App constructor.
     */
    protected function __construct()
    {
        $this->mode = $this->getMode();
        $this->pipline = new Pipline();
    }

    /**
     * @param string $path
     *
     * @return App
     */
    public static function create(string $path): App
    {
        static::set('root_path', $path);

        return new static();
    }

    public function start(): void
    {
        $this->setRegistry();
        $this->setMiddleware();

        echo $this->pipline->run(app(Request::class));
    }

    /**
     * Регистрирует классы в контейнере
     *
     * @noinspection PhpIncludeInspection
     */
    public function setRegistry(): void
    {
        $user_registry = require root_path('/app/registry.php');

        $registry = array_merge(
            require __DIR__ . '/registry.php',
            $user_registry['global'],
            $user_registry[$this->mode]
        );

        array_walk($registry, static function ($value, $key) {
            static::set($key, $value);
        });
    }

    /**
     * Регистрирует Middleware
     */
    protected function setMiddleware(): void
    {
        $this->pipline->pipe('App\\Exceptions\\' . ucfirst($this->mode) . 'ExceptionsMiddleware');

        $this->pipline->pipe(function () {
            return new RouteMiddleware($this->mode);
        });
    }

    /**
     * @return string
     */
    protected function getMode(): string
    {
        if (0 === strpos($_SERVER['REQUEST_URI'], '/api/')) {
            $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], 4);

            return 'api';
        }

        return 'web';
    }
}
