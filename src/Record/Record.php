<?php

/*
 * This file is part of the shiran/easyexmail.
 *
 * (c) shiran
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyExMail\Record;

use Zttp\Zttp;
use Shiran\EasyExMail\Base\Base;

class Record extends Base
{
    /**
     * @param string $domain
     * @param string $start
     * @param string $end
     *
     * @return array
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function overview(string $domain, string $start, string $end)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/log/mailstatus?access_token='.$this->accessToken;

        $query = [
            'domain' => $domain,
            'begin_date' => $start,
            'end_date' => $end,
        ];

        $response = $this->checkException(Zttp::post($url, $query)->json());

        return [
            'sendNum' => $response['sendsum'],
            'receiveNum' => $response['recvsum'],
        ];
    }

    /**
     * @param array $attribute
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function email(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/log/mail?access_token='.$this->accessToken;

        $required = ['begin_date', 'end_date', 'mailtype'];

        $this->checkAttribute($attribute, $required);

        $response = $this->checkException(Zttp::post($url, $attribute)->json());

        return $response['list'];
    }

    /**
     * @param array $attribute
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function login(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/log/login?access_token='.$this->accessToken;

        $required = ['userid', 'begin_date', 'end_date'];

        $this->checkAttribute($attribute, $required);

        $response = $this->checkException(Zttp::post($url, $attribute)->json());

        return $response['list'];
    }

    /**
     * @param array $attribute
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function mission(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/log/batchjob?access_token='.$this->accessToken;

        $required = ['begin_date', 'end_date'];

        $this->checkAttribute($attribute, $required);

        $response = $this->checkException(Zttp::post($url, $attribute)->json());

        return $response['list'];
    }

    /**
     * @param array $attribute
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function operate(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/log/operation?access_token='.$this->accessToken;

        $required = ['type', 'begin_date', 'end_date'];

        $this->checkAttribute($attribute, $required);

        $response = $this->checkException(Zttp::post($url, $attribute)->json());

        return $response['list'];
    }
}
