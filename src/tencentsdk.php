<?php

return [
    'secret_id' => env('TENCENT_SECRET_ID'),
    'secret_key' => env('TENCENT_SECRET_KEY'),
    'token' => null,
    'region' => '',

    'drivers' => [
        // https://github.com/TencentCloud/tencentcloud-sdk-php/tree/master/src/TencentCloud
    	'live' => \TencentCloud\Live\V20180801\LiveClient::class,
        'cvm' => \TencentCloud\Cvm\V20170312\CvmClient::class,
        'mariadb' => \TencentCloud\Mariadb\V20170312\MariadbClient::class,
    ],
    
    // 直播
    'live' => [
        'pull' => [
            // 拉流主key
            'key_main' => env('TENCENT_LIVE_PULL_KEY_MAIN'),
            // 拉流备key 暂未用到
            'key_bak' => env('TENCENT_LIVE_PULL_KEY_BAK'),
            // 拉流协议
            'scheme' => env('TENCENT_LIVE_PULL_SCHEME', 'https'),
            // 拉流域名
            'host' => env('TENCENT_LIVE_PULL_HOST'),
        ],
        'push' => [
            // 推流主key
            'key_main' => env('TENCENT_LIVE_PUSH_KEY_MAIN'),
            // 推流域名
            'host' => env('TENCENT_LIVE_PUSH_HOST'),
        ],
    ],
];