<?php

namespace Puzzle9\TencentCloudSdk;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class TencentCloudSdk extends LaravelFacade
{
    public static function getFacadeAccessor()
    {
        return TencentCloudManage::class;
    }
    
    /**
     * 使用 xx 服务
     * @param string $name 服务名称
     * @return
     */
    public static function with($name)
    {
        return static::getFacadeRoot()->with($name);
    }

    /**
     * live
     * @return \TencentCloud\Live\V20180801\LiveClient
     */
    public static function createLiveDriver()
    {
        return self::with('live');
    }

    /**
     * cvm
     * @return \TencentCloud\Cvm\V20170312\CvmClient
     */
    public static function createCvmDriver()
    {
        return self::with('cvm');
    }
}
