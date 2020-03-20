<?php


namespace app\api\model;


class Theme extends Model
{
    public function topImage()
    {
        return parent::belongsTo(Image::class, 'top_image_id');
    }

    public function headImage()
    {
        return parent::belongsTo(Image::class, 'head_image_id');
    }

    public function product()
    {
        return parent::belongsToMany(Product::class, 'product_theme_pivot');
    }
}