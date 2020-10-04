<?php

namespace app\api\model;

use think\Model;

class Product extends Model
{
    public function coverImage()
    {
        return $this->belongsTo(Image::class);
    }

    public function detailImages()
    {
        return $this->hasMany(Image::class);
    }

    public function productProperty()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function theme()
    {
        return $this->belongsToMany(Theme::class, 'product_theme_pivot');
    }


}