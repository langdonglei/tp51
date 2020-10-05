<?php


namespace app\api\model;


use think\Model;

class Order extends Model
{

    public static function saveGetId($snap)
    {
        self::checkStock($snap);
        $model = new self();
        $model->sn = self::generateSn();
        $model->save();
        return $model->id;
    }

    private static function checkStock($snap)
    {
        $data = Product::all(array_column($snap, 'product_id'));
        foreach ($snap as $order) {
            $index = -1;
            for ($i = 0; $i < count($data); $i++) {
                if ($order['product_id'] == $data[$i]['id']) {
                    $index = $i;
                }
            }
            if ($index == -1) {
                throw new \Exception('非法订单');
            } else {
                if ($order['count'] > $data[$index]['stock']) {
                    throw new \Exception($data[$index]['name'] . '缺货');
                }
            }
        }
    }

    private static function generateSn()
    {
        $str = ['A', 'B', 'C', 'D', 'E', 'F'][date('Y') - 2020]
            . dechex(date('m'))
            . date('d')
            . substr(microtime(true), -10)
            . sprintf('%02d', rand(0, 99));
        $str = str_replace('.', '', $str);
        $str = strtoupper($str);
        return $str;
    }
}