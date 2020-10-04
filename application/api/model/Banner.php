<?php


namespace app\api\model;


use think\Model;

class Banner extends Model
{
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}