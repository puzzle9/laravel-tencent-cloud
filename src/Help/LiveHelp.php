<?php


namespace Puzzle9\TencentCloudSdk\Help;

use Illuminate\Support\Carbon;

use Puzzle9\TencentCloudSdk\Exceptions\InvalidSignException;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * 回调验证
     * @throws InvalidSignException
     * @return array
     */
    public function notifyVerify()
    {
        $key = $this->getConfig()['notify']['key'];
        $t = request()->input('t');
        $sign = request()->input('sign');

        if (md5($key.$t) != $sign) {
            throw new InvalidSignException('Notify Sign Verify FAILED');
        }

        // todo: 回调时间处理
        // if ($t > time()) {
        // }

        return request()->all();
    }

    /**
     * 回调响应
     * @return Response
     */
    public function notifySuccess()
    {
        return new Response(
            json_encode([
                'code' => 0,
            ]),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
