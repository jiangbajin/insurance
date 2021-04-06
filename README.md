### 命名空间

- 命名空间：cncn\insurance;
- 比如"中华财险", "黄河保险", "国华人寿"等对接SDK

### composer.json
```$xslt
{
    "name": "cncn/insurance",
    "description": "欣欣保险通用sdk",
    "keywords": [
        "中华财险", "黄河保险", "国华人寿"
    ],
    "homepage": "http://erp.cncn.net",
    "authors": [
        {
            "name": "jyqin"
        }
    ],
    "require": {
        "php": "^5.6 || ^7.0",
        "cncn/foundation": "dev-master"
    },
    "autoload": {
        "psr-4": {
            "cncn\\insurance\\": "src"
        }
    },
    "repositories": [
        {
            "type": "git",
            "url": "http://172.18.3.16:3000/cncn/foundation.git"
        },
        {
            "type": "composer",
            "url": "https://packagist.phpcomposer.com"
        }
    ],
    "config":{"secure-http":false}
}
```

### auth.json
- 需要注意auth.json，用于http://172.18.3.16:3000git仓库认证

```$xslt
{
  "http-basic": {
    "172.18.3.16:3000": {
      "username": "dev",
      "password": "a123456"
    }
  }
}
```

## 安装
```shell
// 方法一、 使用composer安装
composer require cncn/insurance

// 方法二、 直接加载insurance SDK
include 'init.php'
```

####  SDK 中保险服务提供统一的调用方法，初始化方式如下
```$xslt

//黄河保险
$service = \cncn\insurance\InsuranceFactory::YPIC($config);

```

### Quick Start

##### 黄河保险请求使用示例

```$xslt
include '../../init.php';
// 加载配置参数
$config = require(__DIR__ . '/config.php');

//电子保单参数
$options = array (
    'channel_id' => 'LKJ',
    'request_type' => '2',
    'request_no' => \cncn\foundation\util\UUIDGenerator::numberNo(),
    'biz_content' =>
        array (
            'end_date' => '2019-10-29 23:59:59',
            'amount' => '800000.00',
            'extend_params' =>
                array (
                    'values' => '1',
                    'travelRoute' => '国内',
                    'DomesticInd' => '0',
                ),
            'premium' => '100.00',
            'insured' =>
                array (
                    0 =>
                        array (
                            'address' => '河南小区',
                            'phone' => '13666036274',
                            'sex' => '1',
                            'name' => '程嘉昌',
                            'certi_type' => '01',
                            'type' => '1',
                            'certi_no' => '410922198502159418',
                            'relation' => '0',
                            'email' => '773553241@qq.com',
                        ),
                ),
            'product_id' => '11430010004',
            'trade_no' => \cncn\foundation\util\UUIDGenerator::numberNo(),
            'targets' =>
                array (
                    0 =>
                        array (
                            'occupationCode' => '',
                            'occupationType' => '',
                            'occupationLevel' => '',
                        ),
                ),
            'insure_date' => date('Y-m-d H:i:s', strtotime('+ 2 days')),
            'start_date' => '2019-09-28 00:00:00',
            'applicant' =>
                array (
                    'contactName' => '程嘉昌',
                    'address' => '河南小区',
                    'phone' => '13161084234',
                    'sex' => '1',
                    'name' => '张朝杰',
                    'certi_type' => '01',
                    'type' => '1',
                    'certi_no' => '410922198502159418',
                    'email' => '773553241@qq.com',
                    'officephonenumber' => '0596-6881895',
                ),
        ),
);

try {
    $result = \cncn\insurance\InsuranceFactory::YPIC($config)->booking($options);
    echo '<pre>';
    var_export($result);
} catch (Exception $e) {
    echo $e->getMessage();
}
```