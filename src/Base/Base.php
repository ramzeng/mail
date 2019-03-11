<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-11
 * Time: 15:09
 */

namespace Shiran\EasyExMail\Base;


use Shiran\EasyExMail\Traits\Helper;

class Base
{
    use Helper;

    protected $accessToken;

    public function __construct(array $config)
    {
        $this->accessToken = $this->getAccessToken($config);
    }
}