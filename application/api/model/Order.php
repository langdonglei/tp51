<?php


namespace app\api\model;


use think\Db;
use think\Model;

class Order extends Model
{
    public function handle($data)
    {
        self::check($data);
        $order = new self();
        $order->sn = self::generateSn();
        $order->save();
        foreach ($data as &$item) {
            $item['order_id'] = $order->id;
        }
        Db::insertAll($data);
    }

    private static function check($data)
    {
        $products = Product::all(array_column($data, 'product_id'));
        foreach ($data as $item) {
            $index = -1;
            for ($i = 0; $i < count($products); $i++) {
                if ($item['product_id'] == $products[$i]['id']) {
                    $index = $i;
                }
            }
            if ($index == -1) {
                throw new \Exception('非法订单');
            } else {
                if ($item['count'] > $products[$index]['stock']) {
                    throw new \Exception($products[$index]['name'] . '缺货');
                }
            }
        }
    }

    private function generateSn()
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