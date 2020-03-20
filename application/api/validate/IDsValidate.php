<?php


namespace app\api\validate;


class IDsValidate extends Validate
{
    protected $rule = [
        'ids' => 'require|custom'
    ];

    public function custom($ids)
    {
        foreach (explode(',', $ids) as $v) {
            if (!parent::isPositiveInteger($v)) {
                return false;
            }
        }
        return true;
    }
}