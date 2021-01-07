# laravel-tencent-cloud-sdk

在 `laravel` 用上 `腾讯云分包的sdk`

# 安装

## 基础服务

```shell
composer require puzzle9/laravel-tencent-cloud-sdk -vvv
```

## 相关服务

<https://github.com/tencentcloud-sdk-php>

### 直播

- <https://github.com/tencentcloud-sdk-php/live>

```shell
composer require tencentcloud/live -vvv
```

### ...

# 使用

## 推送配置

```shell
php artisan vendor:publish --tag=laravel-tencentsdk
```

## 更新 `.env`

```dotenv
TENCENT_SECRET_ID=
TENCENT_SECRET_KEY=
```

## 加入相关服务

`config/tencentsdk.php`

```php
    'drivers' => [
    	'live' => \TencentCloud\Live\V20180801\LiveClient::class,
    	// ...
    ],
```

## 使用
- <https://cloud.tencent.com/document/api>

```php
use Puzzle9\TencentCloudSdk\TencentCloudSdk;

// 具体使用方式详见相关服务使用文档
```

### 直播

```php
$live = TencentCloudSdk::with('live');
//or
$live = TencentCloudSdk::createLiveDriver();

$live_help = TencentCloudSdk::with('liveHelp');
//or
$live_help = TencentCloudSdk::createLiveHelpDriver();

// 生成推流地址
$push_url = $live_help->getPushUrl('streamName');

// 生成包含防盗链推的流地址
$push_url = $live_help->getPushUrl('streamName', now()->addHour());

// 获得拉流地址
$push_url = $live_help->getPullUrl('streamName');

// 获得包含防盗链拉的流地址
$push_url = $live_help->getPullUrl('streamName', now()->addHour());

// 直播回调验证
$data = $live_help->notifyVerify();

// 直播回调相应
$live_help->notifySuccess();
```

### ...

# todo
- [ ] `TencentCloudSdk::with` 支持动态文档
- [ ] `TencentCloudSdk::createXXXDriver()` 支持动态创建
- [ ] 不同服务支持动态 `ID` `KEY`
- [ ] 完善 `config/tencentsdk.php` 文件
- [ ] 让其更人性化一点
- [x] 第一个版本

# 感谢
- <https://github.com/larvacent/laravel-tencent-cloud>