<?php

/*
 * This file is part of the shiran/easyexmail.
 *
 * (c) shiran
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyExMail\Group;

use Zttp\Zttp;
use Shiran\EasyExMail\Base\Base;

class Group extends Base
{
    /**
     * ran\EasyExMail\Exception\ReferenceException.
     *
     * @param string $groupId
     *
     * @return mixed
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function find(string $groupId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/group/get';

        $query = [
            'access_token' => $this->accessToken,
            'groupid' => $groupId,
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response;
    }

    /**
     * @param array $attribute
     *
     * @return bool
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function build(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/group/create?access_token='.$this->accessToken;

        $required = ['groupid', 'groupname', 'allow_type'];

        $this->checkAttribute($attribute, $required);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param array $attribute
     *
     * @return bool
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function update(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/group/update?access_token='.$this->accessToken;

        $required = ['groupid'];

        $this->checkAttribute($attribute, $required);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param string $groupId
     *
     * @return bool
     *
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function delete(string $groupId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/group/delete';

        $query = [
            'access_token' => $this->accessToken,
            'groupid' => $groupId,
        ];

        $this->checkException(Zttp::get($url, $query)->json());

        return true;
    }
}
