<?php

namespace App\Models\Users;

use Detection\MobileDetect;

/**
 * Class Auth
 *
 * @property string $password
 * @property int    $country_id
 * @property int    $stealth
 *
 * @package App\Models\Users
 */
class Auth extends User
{
    /**
     * @var mixed
     */
    protected $cnt_message;

    /**
     * @var mixed
     */
    protected $cnt_notify;

    /**
     * @param int    $id
     * @param string $password
     *
     * @return mixed
     */
    public static function init(int $id, string $password)
    {
        $dbh = db();

        $sql = "";

        return $dbh->query($sql)->fetchObject(self::class);
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return isset($this->id);
    }

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return !$this->isUser();
    }

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        if (isset($_SESSION['is_mobile'])) {
            return (bool)$_SESSION['is_mobile'];
        }

        if (isset($_COOKIE['is_mobile'])) {
            return (bool)($_SESSION['is_mobile'] = (int)$_COOKIE['is_mobile']);
        }

        return false;
    }

    /**
     * Определить мобильность
     *
     * @return void
     */
    public function detectMobile()
    {
        if (!isset($_SESSION['is_mobile']) && !isset($_COOKIE['is_mobile']) && !detectBot()) {
            $_SESSION['is_mobile'] = (int)(new MobileDetect())->isMobile();
            setcookie('is_mobile', $_SESSION['is_mobile'], 0x7FFFFFFF, '/', config('domain'));
        }
    }
}
