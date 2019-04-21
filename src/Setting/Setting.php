<?php

/*
 * This file is part of the icecho/easyexmail.
 *
 * (c) icecho <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Icecho\EasyExMail\Setting;

use Icecho\EasyExMail\Base\Base;
use Zttp\Zttp;

class Setting extends Base
{
    /**
     * @param string $userId
     * @param array  $type
     *
     * @return mixed
     *
     * @throws \Icecho\EasyExMail\Exception\ReferenceException
     */
    public function get(string $userId, array $type)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/useroption/get?access_token='.$this->accessToken;

        $query = [
            'userid' => $userId,
            'type' => $type,
        ];

        $response = $this->checkException(Zttp::post($url, $query)->json());

        return $response['option'];
    }

    /**
     * @param string $userId
     * @param array  $option
     *
     * @return bool
     *
     * @throws \Icecho\EasyExMail\Exception\ReferenceException
     */
    public function update(string $userId, array $option)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/useroption/update?access_token='.$this->accessToken;

        $query = [
            'userid' => $userId,
            'option' => $option,
        ];

        $this->checkException(Zttp::post($url, $query)->json());

        return true;
    }
}
