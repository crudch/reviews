<?php

namespace App\Components;

use App\Models\Users\Auth;

/**
 * Class Auth
 *
 * @package App\Components
 */
class Guard
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var \System\Http\Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var bool
     */
    protected $secure;

    public function __construct()
    {
        $this->db = db();
        $this->request = request();
        $this->domain = config('domain');
        $this->secure = config('secure');
    }

    /**
     * @return Auth
     */
    public static function init()
    {
        return new Auth();
    }

    public static function login($user)
    {

    }

    /**
     * Выход с сайта
     */
    public static function logout()
    {

    }
}
