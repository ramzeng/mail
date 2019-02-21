<?php

namespace Shiran\EasyExMail;

use Zttp\Zttp;
use Shiran\EasyExMail\Exception\ReferenceException;

class EasyExMail
{
    protected $corpId;

    protected $corpSecret;

    protected $accessToken;

    /**
     * EasyExMail constructor.
     * @param string $corpId
     * @param string $corpSecret
     * @throws ReferenceException
     */
    public function __construct(string $corpId, string $corpSecret)
    {
        $this->corpId = $corpId;

        $this->corpSecret = $corpSecret;

        $this->getAccessToken();
    }

    /**
     * @return array
     * @throws ReferenceException
     */
    public function getAllDepartments()
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/list';

        $query = [
            'access_token' => $this->accessToken
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'parent_id' => $item['parentid'],
                'order' => $item['order']
            ];
        }, $response['department']);
    }

    /**
     * @param string $name
     * @param int $parentId
     * @param int $order
     * @return array
     * @throws ReferenceException
     */
    public function addDepartment(string $name, int $parentId = 1, int $order = 0)
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
     * @return bool
     * @throws ReferenceException
     */
    public function deleteDepartment(string $departmentId)
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
     * @param int $departmentId
     * @param string $name
     * @param int $parentId
     * @param int $order
     * @return bool
     * @throws ReferenceException
     */
    public function updateDepartment(string $departmentId, string $name, int $parentId = 0, int $order = 0)
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

    /**
     * @param string $name
     * @param int $fuzzy
     * @return array
     * @throws ReferenceException
     */
    public function searchDepartment(string $name, int $fuzzy = 0)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/department/search?access_token=' . $this->accessToken;

        $form = array_filter([
            'name' => $name,
            'fuzzy' => $fuzzy
        ]);

        $response = $this->checkException(Zttp::post($url, $form)->json());

        return array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'parent_id' => $item['parentid'],
                'order' => $item['order']
            ];
        }, $response['department']);
    }

    /**
     * @param array $attribute
     * @return bool
     * @throws ReferenceException
     */
    public function addMember(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/create?access_token=' . $this->accessToken;

        $attribute['userid'] = $attribute['email'];
        unset($attribute['email']);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param array $attribute
     * @return bool
     * @throws ReferenceException
     */
    public function updateMember(array $attribute)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/update?access_token=' . $this->accessToken;

        $attribute['userid'] = $attribute['email'];
        unset($attribute['email']);

        $this->checkException(Zttp::post($url, $attribute)->json());

        return true;
    }

    /**
     * @param $email
     * @return bool
     * @throws ReferenceException
     */
    public function deleteMember(string $email)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/delete';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $email
        ];

        $this->checkException(Zttp::get($url, $query)->json());

        return true;
    }

    /**
     * @param $email
     * @return array
     * @throws ReferenceException
     */
    public function getMember(string $email)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/get';

        $query = [
            'access_token' => $this->accessToken,
            'userid' => $email
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return [
            'email' => $response['userid'],
            'name' => $response['name'],
            'department' => $response['department'],
            'position' => $response['position'],
            'mobile' => $response['mobile'],
            'gender' => $response['gender'],
            'enable' => $response['enable']
        ];
    }

    public function getMemberByDepartment(string $departmentId, int $fetchChild = 1)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/simplelist';

        $query = [
            'access_token' => $this->accessToken,
            'department_id' => $departmentId,
            'fetch_child' => $fetchChild
        ];

        $response = $this->checkException(Zttp::get($url, $query)->json());

        return array_map(function ($item) {
            return [
                'email' => $item['userid'],
                'name' => $item['name'],
                'department' => $item['department']
            ];
        }, $response['userlist']);
    }

    /**
     * @throws ReferenceException
     */
    private function getAccessToken()
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/gettoken';

        $query = [
            'corpid' => $this->corpId,
            'corpsecret' => $this->corpSecret
        ];

        $response = Zttp::get($url, $query)->json();

        $response = $this->checkException($response);

        $this->accessToken = $response['access_token'];
    }

    private function checkException($response)
    {
        if ($response['errcode'] != 0) {
            $error = sprintf('errCode:%s,errMsg:%s', $response['errcode'], $response['errmsg']);
            throw new ReferenceException($error);
        }

        return $response;
    }
}