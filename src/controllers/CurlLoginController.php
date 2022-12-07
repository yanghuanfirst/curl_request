<?php

namespace Yang\UploadTest\controllers;

use App\Http\Controllers\Controller;
use \CurlReq;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ServerException;

class CurlLoginController extends Controller
{
    //
    function login(Request $request){
        $data = $request->only(["username","password"]);
        try{
            $response = CurlReq::postRequest("login",$data);
            $result = $response->getResponse();
            if($result['code'] == 1){
                $token = $result['data']['user_info']['token'];
                dd($token);
            }
        }catch (ServerException $e){
            dd("服务器错误");
        }

    }
    function addUser(Request $request){
        $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93d3cudnVlYWRtaW4uY29tXC9hcGlcL2FkbWluXC9sb2dpbiIsImlhdCI6MTY3MDM4MjMxNCwiZXhwIjoxNjcwNDE4MzE0LCJuYmYiOjE2NzAzODIzMTQsImp0aSI6IndoWllVckZDTWVaQlF2bTgiLCJzdWIiOjEsInBydiI6ImRmODgzZGI5N2JkMDVlZjhmZjg1MDgyZDY4NmM0NWU4MzJlNTkzYTkiLCJndWFyZCI6ImFkbWluX2FwaSJ9.3f1AvVR7fI0GkQCcRNtubVUobGcjSGqG9_L_ZSbOIzE";
        $params = $request->only(['username','password','check_roles','avatar']);
        //$request->file("avatar")->getClientOriginalName()
//dd($params['avatar']->getRealPath());
        $data = [];
        foreach($params as $k=>$v){
           if($k == "check_roles"){
                foreach($v as $vv){
                    $tmp = [
                        "name"=>'check_roles[]',
                        "contents"=>$vv
                    ];
                    $data[] = $tmp;
                }
            }elseif($k == "avatar"){
                //dd(fopen(public_path('favicon.ico'),"r"));
                $tmp = [
                    "name"=>$k,
                    "contents"=>fopen($v->getRealPath(),"r"),
                    //"filename"=>fopen('/path/to/file', 'r')
                ];
                $data[] = $tmp;
            } else{
                $tmp = [
                    "name"=>$k,
                    "contents"=>$v
                ];
                $data[] = $tmp;
            }

        }
        $headers = [
            "Authorization"=>$token
        ];
        $response = CurlReq::postRequest("users/add",$data,$headers);
        $result = $response->getResponse();
        dd($result);

    }
}
