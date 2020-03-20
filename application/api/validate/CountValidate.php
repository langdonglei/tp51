<?php


namespace app\api\validate;


class CountValidate extends Validate
{
    protected $rule = [
        'count' => 'between:1,15|custom'
    ];

    public function custom($value)
    {
        return parent::isPositiveInteger($value);
    }
}