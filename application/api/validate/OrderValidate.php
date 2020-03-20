<?php


namespace app\api\validate;


class OrderValidate extends Validate
{
    protected $rule = [
        'order' => 'require|array|custom'
    ];

    public function custom($value)
    {
        foreach ($value as $v) {
            self::checkProductParameterFormat($v);
        }
        return true;
    }

    private function checkProductParameterFormat($data)
    {
        $validate = new Validate([
            'product_id' => 'require|isPositiveInteger',
            'count'      => 'require|isPositiveInteger'
        ]);
        $validate->doCheck($data);
    }
}