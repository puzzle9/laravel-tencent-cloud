<?php

namespace Puzzle9\TencentCloudSdk\Help;

use Puzzle9\TencentCloudSdk\TencentCloudSdk;
use TencentCloud\Sms\V20210111\Models\SendSmsRequest;

/**
 * 短信 帮助函数
 */
class SmsHelp
{
    public function region()
    {
        return config('tencentsdk.sms.region') ?: config('tencentsdk.region');
    }

    /**
     * 发送短信
     * @url https://console.cloud.tencent.com/api/explorer?Product=sms&Version=2021-01-11&Action=SendSms
     * @param string $phone           手机号
     * @param array  $template_params 短信模板参数
     * @param array  $req_params      请求参数
     * @return false|string
     */
    public function send($phone, $template_params = [], $req_params = [])
    {
        $req = new SendSmsRequest();
        $req->fromJsonString(json_encode([
            'PhoneNumberSet'   => [$phone],
            'SmsSdkAppId'      => config('tencentsdk.sms.sms_sdk_app_id'),
            'SignName'         => config('tencentsdk.sms.sign_name'),
            'TemplateId'       => config('tencentsdk.sms.template_id'),
            'TemplateParamSet' => $template_params,
            ...$req_params,
        ]));

        $sms = TencentCloudSdk::createSmsDriver($this->region());
        $rep = $sms->SendSms($req);

        return $rep->toJsonString();
    }
}
