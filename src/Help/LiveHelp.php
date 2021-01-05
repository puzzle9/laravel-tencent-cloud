<?php


namespace Puzzle9\TencentCloudSdk\Help;

use Illuminate\Support\Carbon;

/**
 * 直播 帮助函数
 */
class LiveHelp
{
    // 获取配置
    private function getConfig()
    {
        return config('tencentsdk.live');
    }
    
    /**
     * 生成加密密文
     * @param string $streamName 流名称
     * @param string $key 密钥
     * @param string | Carbon $time 过期时间
     * @return string
     */
    public function generateEncryptionString($streamName, $key, $time)
    {
        if (!$key) {
            return null;
        }
        
        $txTime = strtoupper(base_convert(strtotime($time), 10, 16));
        $txSecret = md5($key . $streamName . $txTime);
        return '?' . http_build_query([
            'txSecret' => $txSecret,
            'txTime' => $txTime,
        ]);
    }

    /**
     * 获取拉流地址
     * @param string $streamName 流名称
     * @param null | string | Carbon $time 过期时间
     * @param null | string $key 密钥 默认使用主KEY
     * @return array
     */
    public function getPullUrl($streamName, $time = null, $key = null)
    {
        $config = $this->getConfig()['pull'];
        
        $key = $key ?: $config['key_main'];
        $scheme = $config['scheme'];
        $host = $config['host'];

        $encryption = $this->generateEncryptionString($streamName, $key, $time);
        
        return [
            'rtmp' => "rtmp://${host}/live/${streamName}${encryption}",
            'flv' => "${scheme}://${host}/live/${streamName}.flv${encryption}",
            'm3u8' => "${scheme}://${host}/live/${streamName}.m3u8${encryption}",
            'webrtc' => "webrtc://${host}/live/${streamName}.m3u8${encryption}",
        ];
    }
    
    /**
     * 获取推流地址
     * @param string $streamName 流名称
     * @param null | string | Carbon $time 过期时间
     * @param null | string $key 密钥 默认使用主KEY
     * @return string
     */
    public function getPushUrl($streamName, $time = null, $key = null)
    {
        $config = $this->getConfig()['push'];
    
        $key = $key ?: $config['key_main'];
        $host = $config['host'];
    
        $encryption = $this->generateEncryptionString($streamName, $key, $time);

        return "rtmp://${host}/live/${streamName}$encryption";
    }
}