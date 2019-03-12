<h1 align="center"> easyexmail </h1>

<p align="center"> Tencent ExMail SDK.</p>


## 安装

```shell
$ composer require shiran/easyexmail -vvv
```

## 使用

```php
use Shiran\EasyExMail\EasyExMail;

$config = [
    'corpId' => 'your corp id',
    'corpSecret' => 'your corp secret'
];

$easy = new EasyExMail($config);
```

## 部门相关

```php
/**
 * 获取所有部门
 */
$easy->department()->get();

/**
 * 查找部门
 * 参数：
 *  部门名（必填）
 *  是否模糊匹配（可选 0 or 1)
 */
$easy->department()->find('name', 'fuzzy');

/**
 * 删除部门
 * 参数：
 *  部门ID（必填）
 */
$easy->department()->delete('departmentId');

/**
 * 新建部门
 * 参数：
 *  部门名称（必填）
 *  父ID（默认为1）
 *  权重 (默认0)
 */
$easy->department()->build('name', 'parentId', 'order');

/**
 * 更新部门
 * 参数：
 *  部门ID（必填)
 *  部门名称
 *  父ID
 *  权重
 */
$easy->department()->update('departmentId', 'name', 'parentId', 'order');

## 成员相关

```php
/**
 * 查找部门成员
 * 参数：
 *  部门ID（必填)
 *  简易或是详细数据（默认简易）
 *  是否递归子部门成员（默认1）
 */
$easy->member()->get('departmentId', 'type', 'child');

/**
 * 查找成员
 * 参数：
 *  成员ID（必填)
 */
$easy->member()->find('email');

/**
 * 新建成员
 * 参数：
 *  成员ID（必填)
 *  成员姓名（必填)
 *  成员所属部门（必填)
 *  密码（必填)
 */
$easy->member()->build(array $attribute);

/**
 * 删除成员
 * 参数：
 *  成员ID（必填)
 */
$easy->member()->delete('email');

/**
 * 更新成员
 * 参数：
 *  成员ID（必填)
 */
$easy->member()->build(array $attribute);

/**
 * 批量检查账号可用
 * 参数：
 *  账号（必填)
 */
$easy->member()->check(array $list);
```

## 邮件群组相关

```php
/**
 * 创建邮件群组
 * 参数：
 *  账号（必填)
 *  名称（必填）
 *  类型（必填）
 */
$easy->group()->build(array $attribute);

/**
 * 更新邮件群组
 * 参数：
 *  账号（必填)
 */
$easy->group()->update(array $attribute);

/**
 * 删除邮件群组
 * 参数：
 *  账号（必填)
 */
$easy->group()->delete(string $groupId);

/**
 * 查看邮件群组
 * 参数：
 *  账号（必填)
 */
$easy->group()->find(string $groupId);
```

目前就是这些功能，慢慢逐步完善！
## License

MIT
