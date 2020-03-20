<?php


namespace app\api\validate;


class IDValidate extends Validate
{
    protected $rule = [
        'id' => 'require|custom'
    ];

    public function custom($value)
    {
        return parent::isPositiveInteger($value);
    }
}