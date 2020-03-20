<?php


namespace app\api\model;


class ProductProperty extends Model
{
    protected $visible = ['title', 'detail'];

    public function product()
    {
        return parent::belongsTo(Product::class);
    }
}