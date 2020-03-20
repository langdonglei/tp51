<?php


namespace app\api\service;


use app\api\model\Product;

class OrderService
{
    public static function handle($order)
    {
        $data = self::getDataFromDatabase($order);


        foreach ($order as &$v) {
            $v['has_stock'] = false;
            $v['price']     = 0;
            foreach ($data as $vv) {
                if ($v['product_id'] == $vv['id']) {
                    if ($v['count'] <= $vv['stock']) {
                        $v['has_stock'] = true;
                        $v['price']     = $v['count'] * $vv['price'];
                    }
                }
            }
        }

        return self::makeOrderNumber();
    }

    public static function makeOrderNumber()
    {
        return date('y')
            . date('m')
            . date('d')
            . time()
            . substr(microtime(), 2, 6);
    }

    private static function getDataFromDatabase($order)
    {
        $arr = [];
        foreach ($order as $k => $v) {
            $arr[] = $v['product_id'];
        }

        return Product::all($arr)->visible(['id', 'price', 'stock'])->toArray();
    }

}