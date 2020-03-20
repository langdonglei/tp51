<?php


namespace app\api\model;


class Image extends Model
{
    protected $visible = ['url'];

    public function getUrlATTR($value, $data)
    {
        return parent::setUrlPrefix($value, $data);
    }
}