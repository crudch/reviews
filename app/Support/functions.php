<?php

use App\Components\Guard;
use App\Models\Users\Auth;

/**
 * @return Auth
 */
function auth(): Auth
{
    return app(Guard::class);
}
