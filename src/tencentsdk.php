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
];