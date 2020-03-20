<?php


namespace app\api\model;


class ProductImage extends Model
{
    public function product()
    {
        return parent::belongsTo(Product::class);
    }

    public function image()
    {
        return parent::belongsTo(Image::class);
    }
}