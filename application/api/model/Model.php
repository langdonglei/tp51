<?php


namespace app\api\model;


class Model extends \think\Model
{
    protected $hidden = ['create_at', 'delete_at', 'update_at', 'remark', 'pivot'];

    public $autoWriteTimestamp = true;

    public function setUrlPrefix($value, $data)
    {
        if (1 == $data['type']) {
            $value = config('image.prefix') . $value;
        }
        return $value;
    }
}