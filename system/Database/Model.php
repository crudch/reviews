<?php

namespace System\Database;

/**
 * Class Model
 *
 * @package System\Database
 */
abstract class Model
{
    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->{$name});
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     */
    public function __set(string $name, $value)
    {
        if (method_exists($this, $method = $this->generateMethod('set', $name))) {
            return $this->$method($value);
        }

        return $this->specialSet($name, $value);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (method_exists($this, $method = $this->generateMethod('get', $name))) {
            return $this->$method($name);
        }

        return null;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     */
    protected function specialSet(string $name, $value)
    {
        return $this->{$name} = $value;
    }

    /**
     * Генерирует метод
     *
     * @param string $particle
     * @param string $data
     *
     * @return string
     */
    protected function generateMethod(string $particle, string $data): string
    {
        $method = array_map('ucfirst', explode('_', $data));

        return $particle . implode('', $method);
    }
}
