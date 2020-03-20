<?php


namespace app\api\model;


class Model extends \think\Model
{
    public $autoWriteTimestamp = true;

    public function setUrlPrefix($value, $data)
    {
        if (1 == $data['type']) {
            $value = config('image_prefix') . $value;
        }
        return $value;
    }
}