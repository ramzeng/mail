<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-03-11
 * Time: 14:06
 */

namespace Shiran\EasyExMail\Department;

use Zttp\Zttp;
use Shiran\EasyExMail\Base\Base;

class Department extends Base
{
    /**
     * @return array
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function get()
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/list';

        $query = [
            'access_token' => $this->accessToken
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return $response['department'];
    }

    /**
     * @param string $name
     * @param int $fuzzy
     * @return array
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function find(string $name, int $fuzzy = 0)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/search?access_token=' . $this->accessToken;

        $form = array_filter([
            'name' => $name,
            'fuzzy' => $fuzzy
        ]);

        $response = $this->checkException(Zttp::post($url, $form)->json());

        return $response['department'];
    }

    /**
     * @param int $departmentId
     * @return bool
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function delete(int $departmentId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/delete';

        $query = [
            'access_token' => $this->accessToken,
            'id' => $departmentId
        ];

        $this->checkException(Zttp::get($url, $query)->json());

        return true;
    }

    /**
     * @param string $name
     * @param int $parentId
     * @param int $order
     * @return array
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function build(string $name, int $parentId = 1, int $order = 0)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/create?access_token=' . $this->accessToken;

        $form = [
            'name' => $name,
            'parentid' => $parentId,
            'order' => $order
        ];

        $response = $this->checkException(Zttp::post($url, $form)->json());

        return [
            'name' => $name,
            'department_id' => $response['id']
        ];
    }

    /**
     * @param int $departmentId
     * @param string $name
     * @param int $parentId
     * @param int $order
     * @return bool
     * @throws \Shiran\EasyExMail\Exception\ReferenceException
     */
    public function update(int $departmentId, string $name = '', int $parentId = 0, int $order = 0)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/update?access_token=' . $this->accessToken;

        $form = array_filter([
            'id' => $departmentId,
            'name' => $name,
            'parentid' => $parentId,
            'order' => $order
        ]);

        $this->checkException(Zttp::post($url, $form)->json());

        return true;
    }
}