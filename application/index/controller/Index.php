<?php


namespace app\index\controller;


use app\api\model\Image;
use think\facade\Request;

class Index
{
    public function index()
    {
        return view();
    }

    public function up()
    {
        $files = Request::file('files');
        foreach ($files as $file) {
            $info = $file->move('static/image');
            if ($info) {
//                Image::create([
//                    'type' => 1,
//                    'url'  => $info->getSaveName()
//                ]);
                $m = new Image();
                $m->type = 1;
                $m->url = $info->getSaveName();
                $m->save();
                echo $m->create_at;
                echo 'ok';
            } else {

                echo $file->getError();
            }
        }
    }
}