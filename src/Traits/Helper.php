<?php

/*
 * This file is part of the icecho/easyexmail.
 *
 * (c) icecho <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Icehco\EasyExMail\Traits;

use Icehco\EasyExMail\Exception\InvalidArgumentException;
use Icehco\EasyExMail\Exception\ReferenceException;
use Zttp\Zttp;

trait Helper
{
    /**
     * @param $config
     *
     * @return mixed
     *
     * @throws ReferenceException
     */
    public function getAccessToken($config)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/gettoken';

        $query = [
            'corpid' => $config['corpId'],
            'corpsecret' => $config['corpSecret'],
        ];

        $response = Zttp::get($url, $query)->json();

        $response = $this->checkException($response);

        return $response['access_token'];
    }

    /**
     * @param $response
     *
     * @return mixed
     *
     * @throws ReferenceException
     */
    public function checkException($response)
    {
        if (0 != $response['errcode']) {
            $error = sprintf('errCode:%s,errMsg:%s', $response['errcode'], $response['errmsg']);

            throw new ReferenceException($error);
        }

        return $response;
    }

    public function checkAttribute(array $attribute, array $required)
    {
        array_walk($required, function ($value) use ($attribute) {
            if (!array_key_exists($value, $attribute)) {
                throw new InvalidArgumentException("Attribute {$value} is required");
            }
        });
    }
}
