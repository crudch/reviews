<?php

use System\Routing\Router;

/**
 * @var Router $route
 */

$route->group('/cabinet', static function (Router $router) {
    $router->get('/info', 'IndexController@test');
});
