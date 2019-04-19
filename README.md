<h1 align="center"> easyexmail </h1>

<p align="center"> Tencent ExMail SDK.</p>

![StyleCI build status](https://github.styleci.io/repos/171849879/shield) 

## 官方文档
[查看](https://exmail.qq.com/qy_mng_logic/doc#10001)
目前SDK只有主动调用，暂无回调模式。

## 安装

```shell
$ composer require icehco/easyexmail -vvv
```

## 使用

```php
use Icehco\EasyExMail\EasyExMail;

$config = [
    'corpId' => 'your corp id',
    'corpSecret' => 'your corp secret'
];

$easy = new EasyExMail($config);
```

## 在Laravel中使用

进入config/service.php:

```php
'EasyExMail' => [
    'id' => env('EX_MAIL_ID'),
    'secret' => env('EX_MAIL_SECRET')
]
```

进入.env：

```bash
EX_MAIL_ID=xxxxxx
EX_MAIL_SECRET=xxxxxx
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
```

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
$easy->member()->update(array $attribute);

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
## 功能设置相关

```php
/**
 * 查看设置
 * 参数：
 *  账号（必填)
 *  类型（必填）
 */
$easy->setting()->get(string $userId, array $type);

/**
 * 更新设置
 * 参数：
 *  账号（必填)
 *  设置（必填）
 */
$easy->setting()->update(string $userId, array $option);
```
## 系统日志相关

```php
/**
 * 查看概况
 * 参数：
 *  域名（必填)
 *  起点日期（必填）
 *  终点日期（必填）
 */
$easy->record()->overview(string $domain, string $start, string $end);

/**
 * 查询邮件
 * 参数：
 *  类型（必填)
 *  起点日期（必填）
 *  终点日期（必填）
 */
$easy->record()->email(array $attribute);

/**
 * 查询登录日志
 * 参数：
 *  用户ID（必填)
 *  起点日期（必填）
 *  终点日期（必填）
 */
$easy->record()->login(array $attribute);

/**
 * 查询批量任务
 * 参数：
 *  起点日期（必填）
 *  终点日期（必填）
 */
$easy->record()->mission(array $attribute);

/**
 * 查询操作日志
 * 参数：
 *  起点日期（必填）
 *  终点日期（必填）
 *  类型（必填）
 */
$easy->record()->operate(array $attribute);
```
## 其他功能

```php
/**
 * 查询未读邮件数
 * 参数：
 *  起点日期（必填）
 *  终点日期（必填）
 *  用户ID（必填）
 */
$easy->aider()->unreadEmail(string $userId, string $start, string $end);

/**
 * 单点登录
 * 参数：
 *  用户ID（必填）
 */
$easy->aider()->login(string $userId);
```

I like php, laravel, and overtrue !

## License

MIT
