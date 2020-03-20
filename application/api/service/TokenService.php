<?php


namespace app\api\service;


use app\api\model\User;
use Exception;

class TokenService
{
    private static function getRandomString($length = 32)
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $ret = '';
        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, strlen($str) - 1);
            $ret   .= $str[$index];
        }

        return $ret;
    }

    public static function getToken($code)
    {
        $url = sprintf(
            config('weixin.url'),
            config('weixin.appid'),
            config('weixin.secret'),
            $code);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1
        ]);
        $res = curl_exec($ch);
        $msg = curl_error($ch);
        if ($msg) {
            throw new Exception($msg);
        }
        $arr = json_decode($res, true);

        if (empty($arr)) {
            throw new Exception('code2session request failed');
        } else {
            if (array_key_exists('errcode', $arr)) {
                throw new Exception($arr['errmsg']);
            } else {
                $user = User::where('openid', $arr['openid'])->findOrEmpty();
                if ($user->isEmpty()) {
                    $user = User::create(['openid' => $arr['openid']]);
                }
                $arr['uid']   = $user->id;
                $arr['level'] = 1;

                $key   = self::getRandomString();
                $value = json_encode($arr);
                cache($key, $value, 36000);

                return $key;
            }
        }
    }

    public static function auth($level = 0)
    {
        $key = request()->header('token');
        if (!$key) {
            throw new Exception('header need a token');
        }

        $arr = cache($key);
        if (!is_array($arr)) {
            $arr = json_decode($arr, true);
        }
        if (false == $arr || !array_key_exists('uid', $arr) || !array_key_exists('level', $arr)) {
            throw new Exception('token is expired');
        }

        $user = User::whereNull('delete_at')->findOrEmpty($arr['uid']);
        if (!$user->isEmpty() && $arr['level'] > $level) {
            return true;
        }
        return false;
    }
}