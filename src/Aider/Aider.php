<?php

/*
 * This file is part of the shiran/easyexmail.
 *
 * (c) shiran <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyExMail\Aider;

use Shiran\EasyExMail\Base\Base;
use Zttp\Zttp;

class Aider extends Base
{
    /**
     * @param string $userId
     * @param string $start
     * @param string $end
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function unreadEmail(string $userId, string $start, string $end)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/mail/newcount';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $userId,
            'begin_date' => $start,
            'end_date' => $end,
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response['count'];
    }

    /**
     * @param string $userId
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function loginUrl(string $userId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/service/get_login_url';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $userId,
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return [
            'url' => $response['login_url'],
            'expired_at' => date('Y-m-d H:i:s', time() + $response['expires_in']),
        ];
    }
}
