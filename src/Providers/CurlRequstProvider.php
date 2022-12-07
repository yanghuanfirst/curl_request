<?php

namespace Yang\UploadTest\Providers;

use Illuminate\Support\ServiceProvider;
use Yang\UploadTest\lib\CurlRequest;

class CurlRequstProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton("curl_request",function($app){
            return new CurlRequest();
        });
        $this->loadRoutesFrom(__DIR__."/../routes/api.php");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
