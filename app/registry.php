<?php

/**
 * Регистрация кастомных классов
 */

use App\Components\SxGeo;
use App\Components\Guard;
use Cocur\Slugify\Slugify;
use App\Components\RuleProviderSlugify;

return [
    'global' => [
        Guard::class   => static fn() => Guard::init(),
        Slugify::class => static fn() => new Slugify(['rulesets' => ['russian']], new RuleProviderSlugify()),
        //SxGeo::class => static fn() => new SxGeo(root_path('/assets/resources/sgc-2020-09-30.dat')),
    ],
    'web'    => [],
    'api'    => [],
];
