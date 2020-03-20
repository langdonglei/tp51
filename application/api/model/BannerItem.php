<?php


namespace app\api\model;


class BannerItem extends Model
{
    public function banner()
    {
        return parent::belongsTo(Banner::class);
    }

    public function image()
    {
        return parent::belongsTo(Image::class);
    }
}