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

// 获取所有部门
$easy->department()->get();

// 查找部门
参数：
    部门名（必填）
    是否模糊匹配（可选 0 or 1)
$easy->department()->find('name');

```
## License

MIT