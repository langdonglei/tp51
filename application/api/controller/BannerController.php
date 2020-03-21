<?php


namespace app\api\controller;


use app\api\model\Banner;
use app\api\validate\IDValidate;
use think\Db;

class BannerController extends Controller
{
    public function one($id)
    {
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