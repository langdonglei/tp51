<?php


namespace app\api\validate;


class UserAddressValidate extends Validate
{
    protected $rule = [
        'id'       => 'require|custom',
        'name'     => 'require',
        'mobile'   => 'require',
        'country'  => 'require',
        'province' => 'require',
        'city'     => 'require',
        'detail'   => 'require',
    ];

    public function custom($value)
    {
        return parent::isPositiveInteger($value);
    }
}