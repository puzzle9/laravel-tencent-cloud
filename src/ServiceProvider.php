<?php


namespace Puzzle9\TencentCloudSdk;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/tencentsdk.php' => config_path('tencentsdk.php'),
        ], 'laravel-tencentsdk');
    }
    
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/src/tencentsdk.php', 'tencentsdk');
    }
}