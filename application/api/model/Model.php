<?php


namespace app\api\model;


class Model extends \think\Model
{
    protected $hidden = ['pivot', 'remark', 'delete_time', 'create_time', 'update_time'];

    public $autoWriteTimestamp = true;


    public function setUrlPrefix($value, $data)
    {
        if (1 == $data['type']) {
            $value = config('image.prefix') . $value;
        }
        return $value;
    }
}