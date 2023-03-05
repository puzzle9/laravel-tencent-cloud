# laravel-tencent-cloud-sdk

在 `laravel` 用上 `腾讯云分包的sdk`

# 安装

## 基础服务

```shell
composer require puzzle9/laravel-tencent-cloud-sdk -vvv
```

## 推送配置

```shell
php artisan vendor:publish --tag=laravel-tencentsdk
```

## 更新 `.env`

```dotenv
TENCENT_SECRET_ID=
TENCENT_SECRET_KEY=
```

# 使用

- <https://cloud.tencent.com/document/api>

```php
use Puzzle9\TencentCloudSdk\TencentCloudSdk;

// 具体使用方式详见相关服务使用文档
```

## 直播

```shell
composer require tencentcloud/live -vvv
```

### 加入相关服务

`config/tencentsdk.php`

```php
    'drivers' => [
    	'live' => \TencentCloud\Live\V20180801\LiveClient::class,
    	// ...
    ],
```

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

## 实时音视频 / im

### 获取 UserSig

```shell
composer require tencent/tls-sig-api-v2 -vvv
```

### 实时音视频

```shell
composer require tencentcloud/trtc -vvv
```

#### 加入相关服务

`config/tencentsdk.php`

```php
    'drivers' => [
        'trtc' => \TencentCloud\Trtc\V20190722\TrtcClient::class,
    	// ...
    ],
```

```php
$trtc = TencentCloudSdk::with('trtc');
//or
$trtc = TencentCloudSdk::createTrtcDriver();

$trtc_help = TencentCloudSdk::with('trtcHelp');
//or
$trtc_help = TencentCloudSdk::createTrtcHelpDriver();

// 获取 trtc sdk appid
$trtc_sdk_appid = $trtc_help->getSdkAppId();

// 获取 user sig
$sig = $trtc_help->userSig();
$user_sig = $sig->genUserSig('user_id');
```

### im

- [ ] 重写 <https://github.com/puzzle9/laravel-tencent-cloud-sdk-im>

## 短信

```shell
composer require tencentcloud/sms -vvv
```

### 加入相关服务

`config/tencentsdk.php`

```php
    'drivers' => [
        'sms' => \TencentCloud\Sms\V20210111\SmsClient::class,
        // ...
    ],
    
     // 短信
    'sms'     => [
        'region'         => 'ap-beijing',
        'sms_sdk_app_id' => env('TENCENT_SMS_APP_ID'),
        'sign_name'      => env('TENCENT_SMS_SIGN_NAME'),
        'template_id'    => env('TENCENT_SMS_TEMPLATE_ID'),
    ],
```

```php
$sms = TencentCloudSdk::with('sms');
//or
$sms = TencentCloudSdk::createSmsDriver();

$sms_help = TencentCloudSdk::with('smsHelp');
//or
$sms_help = TencentCloudSdk::createSmsHelpDriver();

// 发送短信
$sms_help->send('手机号', [
    '模板参数1',
])
```

## ...

# todo

- [ ] `TencentCloudSdk::with` 支持动态文档
- [ ] `TencentCloudSdk::createXXXDriver()` 支持动态创建
- [ ] 不同服务支持动态 `ID` `KEY`
- [ ] 完善 `config/tencentsdk.php` 文件
- [ ] 让其更人性化一点
- [x] 第一个版本

# 感谢

- <https://github.com/larvacent/laravel-tencent-cloud>