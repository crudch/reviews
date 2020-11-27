<?php

/** @noinspection PhpIncludeInspection */

use System\Cache\Cache;
use System\Http\Request;
use System\Database\Connection;

return [
    /**
     * Загрузка Config
     */
    'global_config' => require root_path('/config.php'),

    /**
     * Инициализация Request
     */
    Request::class => static function () {
        return new Request();
    },

    /**
     * Инициализация подключения базе данных
     */
    Connection::class => static function () {
        return Connection::connect();
    },

    /**
     * Инициализация Cache
     */
    Cache::class => static function () {
        $cache_driver = config('cache_driver');

        return new Cache(new $cache_driver(root_path('/cache')));
    },
];
