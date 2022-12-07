<?php

namespace Yang\UploadTest\Facade;

use Illuminate\Support\Facades\Facade;

class CurlFacade extends Facade
{
    static function getFacadeAccessor(){
        return "curl_request";
    }
}
