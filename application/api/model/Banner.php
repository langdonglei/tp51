<?php


namespace app\api\model;


class Banner extends Model
{
    public function bannerItem()
    {
        return parent::hasMany(BannerItem::class);
    }

}