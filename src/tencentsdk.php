<?php

return [
    'secret_id'  => env('TENCENT_SECRET_ID'),
    'secret_key' => env('TENCENT_SECRET_KEY'),
    'token'      => null,
    'region'     => '',

    'drivers' => [
        // https://github.com/TencentCloud/tencentcloud-sdk-php/tree/master/src/TencentCloud
        'live'    => \TencentCloud\Live\V20180801\LiveClient::class,
        'cvm'     => \TencentCloud\Cvm\V20170312\CvmClient::class,
        'mariadb' => \TencentCloud\Mariadb\V20170312\MariadbClient::class,
        'trtc'    => \TencentCloud\Trtc\V20190722\TrtcClient::class,
        'sms'     => \TencentCloud\Sms\V20210111\SmsClient::class,
    ],

    // 直播
    'live'    => [
        'notify' => [
            'key' => env('TENCENT_LIVE_NOTIFY_KEY'),
        ],
        'pull'   => [
            // 拉流主key
            'key_main' => env('TENCENT_LIVE_PULL_KEY_MAIN'),
            // 拉流备key 暂未用到
            'key_bak'  => env('TENCENT_LIVE_PULL_KEY_BAK'),
            // 拉流协议
            'scheme'   => env('TENCENT_LIVE_PULL_SCHEME', 'https'),
            // 拉流域名
            'host'     => env('TENCENT_LIVE_PULL_HOST'),
        ],
        'push'   => [
            // 推流主key
            'key_main' => env('TENCENT_LIVE_PUSH_KEY_MAIN'),
            // 推流域名
            'host'     => env('TENCENT_LIVE_PUSH_HOST'),
        ],
    ],

    // 实时音视频
    'trtc'    => [
        'sdk_appid'  => env('TENCENT_RTC_SDK_APPID'),
        'sdk_secret' => env('TENCENT_RTC_SDK_SECRET'),
    ],

    // 短信
    'sms'     => [
        // 地域参数
        'region'         => 'ap-beijing',
        // 短信 SdkAppId
        'sms_sdk_app_id' => env('TENCENT_SMS_APP_ID'),
        // 短信签名
        'sign_name'      => env('TENCENT_SMS_SIGN_NAME'),
        // 模板 ID
        'template_id'    => env('TENCENT_SMS_TEMPLATE_ID'),
    ],
];