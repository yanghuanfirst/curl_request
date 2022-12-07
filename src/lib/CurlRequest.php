<?php

namespace Yang\UploadTest\lib;
use GuzzleHttp\Client;


class CurlRequest
{
    private $client;
    private $response;
    function __construct(){
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://www.vueadmin.com/api/admin/',
            // You can set any number of default request options.
            'timeout'  => 5.0,
        ]);
    }
    function getRequest($uri,$params = [],$headers = []){
        $this->response = $this->client->get($uri,[
            'query'=>$params,
            'headers'=>$headers
        ]);
        return $this;
    }
    function postRequest($uri,$data = [],$headers = []){
            $contentType = $_SERVER['CONTENT_TYPE']?$_SERVER['CONTENT_TYPE']:"";
            $params = [
                'form_params'=>$data,
                'headers'=>$headers
            ];
            if($contentType != "application/x-www-form-urlencoded"){
                $params = [
                    'multipart'=>$data,
                    'headers'=>$headers
                ];
            }
            //dd($params);
            $this->response = $this->client->post($uri,$params);
            return $this;



    }

    function getResponse($getResponseObj = false){
        return $getResponseObj?$this->response:json_decode($this->response->getBody()->getContents(),true);
    }
}
