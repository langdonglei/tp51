<?php


namespace app\api\controller;


use app\api\model\Theme;
use app\api\validate\IDSValidate;

class ThemeController extends Controller
{
    public function some($ids)
    {
        $data = ['ids' => input('ids')];

        (new IDSValidate)->doCheck($data);

        $result = Theme::with('topImage,headImage,product')->select($ids);;
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }
}