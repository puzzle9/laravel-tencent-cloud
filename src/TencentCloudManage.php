<?php


namespace Puzzle9\TencentCloudSdk;

use TencentCloud\Common\Credential;

use InvalidArgumentException;

class TencentCloudManage
{
    /**
     * 获取凭证
     * @return Credential
     */
    public function getCredential()
    {
        $config = config('tencentsdk');
        
        $secret_id = $config['secret_id'];
        $secret_key = $config['secret_key'];
        
        if (!$secret_id) {
            throw new InvalidArgumentException('error tencentsdk secret_id');
        }

        if (!$secret_key) {
            throw new InvalidArgumentException('error tencentsdk secret_key');
        }
        
        return new Credential($secret_id, $secret_key, $config['token']);
    }
    
    /**
     * 获取相关服务
     * @param string $name 服务名称
     */
    public function with(string $name)
    {
        if (strstr($name, 'Help')) {
            $class_name = ucfirst($name);
            $help = "Puzzle9\\TencentCloudSdk\\Help\\${class_name}";
            return new $help;
        }

        $config = config('tencentsdk');
        
        $credential = $this->getCredential();
        
        $drivers = $config['drivers'];
        
        $client = isset($drivers[$name]) ? $drivers[$name] : null;
        
        if (!$client) {
            throw new InvalidArgumentException("error $name in tencentsdk drivers");
        }
        
        return new $client($credential, $config['region']);
    }
}