<?php

use App\Components\Guard;
use App\Models\Users\Auth;

/**
 * @return Auth
 */
function auth()
{
    return app(Guard::class);
}
