<?php


namespace app\api\controller;


use app\api\service\TokenService;
use app\api\validate\TokenValidate;

class TokenController extends Controller
{
    public function get($code)
    {
        $data = ['code' => input('code')];

        (new TokenValidate)->doCheck($data);

        $result = TokenService::getToken($data['code']);

        return ['token' => $result];
    }
}