<?php


namespace app\api\model;


class Category extends Model
{
    public function image()
    {
        return parent::belongsTo(Image::class);
    }

    public function getUrlAttr($value, $data)
    {
        return parent::setUrlPrefix($value, $data);
    }
}