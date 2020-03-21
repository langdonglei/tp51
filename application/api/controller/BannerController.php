<?php


namespace app\api\controller;


use app\api\model\Banner;
use app\api\validate\IDValidate;
use think\Db;

class BannerController extends Controller
{
    public function one($id)
    {
        $a = new \PDO('pgsql:host=47.244.119.64;dbname=postgres','postgres','postgres');
        var_dump($a);die;
        $data = [
            'id' => input('id')
        ];

        (new IDValidate())->doCheck($data);

        $result = Banner::with('bannerItem')->findOrEmpty($data['id']);
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }
}