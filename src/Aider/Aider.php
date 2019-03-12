<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-12
 * Time: 14:48
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
     * @return mixed
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function unreadEmail(string $userId, string $start, string $end)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/mail/newcount';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $userId,
            'begin_date' => $start,
            'end_date' => $end
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response['count'];
    }

    /**
     * @param string $userId
     * @return mixed
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function loginUrl(string $userId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/service/get_login_url';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $userId
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return [
            'url' => $response['login_url'],
            'expired_at' => date('Y-m-d H:i:s', time() + $response['expires_in'])
        ];
    }
}