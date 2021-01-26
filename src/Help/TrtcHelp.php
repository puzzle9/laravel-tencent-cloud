<?php


namespace Puzzle9\TencentCloudSdk\Help;

use Tencent\TLSSigAPIv2;

/**
 * 实时音视频 帮助函数
 */
class TrtcHelp
{
    // 获取 sdk_appid
    public function getSdkAppId()
    {
        return config('tencentsdk.trtc.sdk_appid');
    }
    
    /**
     * 获取 user sig
     */
    public function userSig()
    {
        $secret = config('tencentsdk.trtc.sdk_secret');
        return new TLSSigAPIv2($this->getSdkAppId(), $secret);
    }
}