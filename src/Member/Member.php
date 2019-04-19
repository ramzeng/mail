<?php

/*
 * This file is part of the Icehco/easyexmail.
 *
 * (c) Icehco <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Icehco\EasyExMail\Member;

use Zttp\Zttp;
use Icehco\EasyExMail\Base\Base;

class Member extends Base
{
    /**
     * @param int    $departmentId
     * @param string $type
     * @param int    $fetchChild
     *
     * @return array
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function get(int $departmentId, string $type = 'simple', int $fetchChild = 1)
    {
        $simple = 'https://api.exmail.qq.com/cgi-bin/user/simplelist';
        $detail = 'https://api.exmail.qq.com/cgi-bin/user/list';

        $url = 'simple' == $type ? $simple : $detail;

        $query = [
            'access_token' => $this->accessToken,
            'department_id' => $departmentId,
            'fetch_child' => $fetchChild,
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response['userlist'];
    }

    /**
     * @param string $email
     *
     * @return array
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function find(string $email)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/get';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $email,
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response;
    }

    /**
     * @param array $attribute
     *
     * @return bool
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function build(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/create?access_token='.$this->accessToken;

        $attribute = array_filter($attribute);

        $required = ['userid', 'name', 'department', 'password'];

        $this->checkAttribute($attribute, $required);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param string $email
     *
     * @return bool
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function delete(string $email)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/delete';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $email,
        ];

        $this->checkException(Zttp::get($url, $query)->json());

        return true;
    }

    /**
     * @param array $attribute
     *
     * @return bool
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function update(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/update?access_token='.$this->accessToken;

        $attribute = array_filter($attribute);

        $required = ['userid'];

        $this->checkAttribute($attribute, $required);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param array $list
     *
     * @return mixed
     *
     * @throws \Icehco\EasyExMail\Exception\ReferenceException
     */
    public function check(array $list)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/batchcheck?access_token='.$this->accessToken;

        $required = ['userlist'];

        $this->checkAttribute($list, $required);

        $response = $this->checkException(Zttp::post($url, $list)->json());

        return $response['list'];
    }
}
