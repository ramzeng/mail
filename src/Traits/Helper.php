<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-11
 * Time: 14:32
 */

namespace Shiran\EasyExMail\Traits;


use Shiran\EasyExMail\Exception\InvalidArgumentException;
use Shiran\EasyExMail\Exception\ReferenceException;
use Zttp\Zttp;

trait Helper
{
    /**
     * @param $config
     * @return mixed
     * @throws ReferenceException
     */
    public function getAccessToken($config)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/gettoken';

        $query = [
            'corpid' => $config['corpId'],
            'corpsecret' => $config['corpSecret']
        ];

        $response = Zttp::get($url, $query)->json();

        $response = $this->checkException($response);

        return $response['access_token'];
    }

    /**
     * @param $response
     * @return mixed
     * @throws ReferenceException
     */
    public function checkException($response)
    {
        if ($response['errcode'] != 0) {
            $error = sprintf('errCode:%s,errMsg:%s', $response['errcode'], $response['errmsg']);
            throw new ReferenceException($error);
        }

        return $response;
    }

    public function checkAttribute(array $attribute, array $required)
    {
        $attribute = array_filter($attribute);

        array_walk($required, function ($value) use ($attribute) {
            if (!array_key_exists($value, $attribute)) {
                throw new InvalidArgumentException("Attribute {$value} is required");
            }
        });
    }
}