<?php


namespace app\api\validate;


class TokenValidate extends Validate
{
    protected $rule = [
        'code' => 'require'
    ];
}