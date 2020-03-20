<?php


namespace app\api\validate;


class CategoryIDValidate extends Validate
{
    protected $rule = [
        'category_id' => 'require|custom'
    ];

    public function custom($value)
    {
        return parent::isPositiveInteger($value);
    }
}