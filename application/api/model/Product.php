<?php


namespace app\api\model;


class Product extends Model
{
    protected $visible = ['id', 'title', 'price', 'stock'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function productProperty()
    {
        return parent::hasMany(ProductProperty::class);
    }

    public function productImage()
    {
        return parent::hasMany(ProductImage::class);
    }

    public function theme()
    {
        return parent::belongsToMany(Theme::class, 'product_theme_pivot');
    }


}