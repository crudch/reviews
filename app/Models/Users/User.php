<?php

namespace App\Models\Users;

use ArrayAccess;
use System\Database\Model;

/**
 * Class User
 *
 * @property int    $id
 *
 * @package App\Models\Users
 */
class User extends Model implements ArrayAccess
{

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    protected function specialSet($name, $value)
    {
        return $this->{$name} = is_numeric($value) ? (int)$value : $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->{$offset};
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }
}
