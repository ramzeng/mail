<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-12
 * Time: 14:22
 */

namespace Shiran\EasyExMail\Setting;


use Shiran\EasyExMail\Base\Base;
use Zttp\Zttp;

class Setting extends Base
{
    /**
     * @param string $userId
     * @param array $type
     * @return mixed
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function get(string $userId, array $type)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/useroption/get?access_token=' . $this->accessToken;

        $query = [
            'userid' => $userId,
            'type' => $type
        ];

        $response = $this->checkException(Zttp::post($url, $query)->json());

        return $response['option'];
    }

    /**
     * @param string $userId
     * @param array $option
     * @return bool
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function update(string $userId, array $option)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/useroption/update?access_token=' . $this->accessToken;

        $query = [
            'userid' => $userId,
            'option' => $option
        ];

        $this->checkException(Zttp::post($url, $query)->json());

        return true;
    }
}