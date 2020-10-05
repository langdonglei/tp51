<?php


namespace app\api\model;


use think\Db;
use think\Model;

class Snap extends Model
{
    public static function saveData($snap)
    {
        $order_id = Order::saveGetId($snap);
        foreach ($snap as &$item) {
            $item['order_id'] = $order_id;
        }
        Db::table('snap')->insertAll($snap);
    }
}