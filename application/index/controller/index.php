<?php


namespace app\index\controller;


use app\api\model\Image;
use think\facade\Request;

class index
{
    public function index()
    {
        return view();
    }

    public function up()
    {
        $files = Request::file('files');
        foreach ($files as $file) {
            $info = $file->move('../image');
            if ($info) {
                Image::create([
                    'url' => $info->getPathName()
                ]);
            } else {
                echo $info->getError();
            }
        }
    }
}