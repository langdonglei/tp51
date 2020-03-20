<?php


namespace app\api\validate;


use Exception;
use think\facade\Request;

class Validate extends \think\Validate
{
    protected $batch = true;

    public function doCheck($data)
    {
        if (!parent::check($data)) {
            throw new Exception(implode(',', $this->error));
        }
    }

    public function isPositiveInteger($value)
    {
        if (preg_match('|^\d+$|', $value)) {
            return true;
        } else {
            return false;
        }
    }
}