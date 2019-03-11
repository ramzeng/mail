<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-11
 * Time: 13:52
 */

namespace Shiran\EasyExMail;

use Shiran\EasyExMail\Exception\InvalidArgumentException;

class Factory
{
    /**
     * @param $name
     * @param array $config
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function make($name, $config)
    {
        $name = self::formatClassName($name);
        if (!class_exists($name)) {
            throw new InvalidArgumentException('class is not exist');
        }
        $instance = new $name($config);

        return $instance;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function formatClassName(string $name)
    {
        $name = ucfirst($name);

        return __NAMESPACE__ . "\\{$name}\\{$name}";
    }
}