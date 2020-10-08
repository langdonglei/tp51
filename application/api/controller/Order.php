<?php


namespace app\api\controller;


use app\api\model\Order as Model;
use think\Controller;

class Order extends Controller
{
    protected $failException = true;

    public function submit()
    {
        # validate
        $this->validate($this->request->post(), [
            'data' => [
                'require',
                # 以下两条规则验证的是
                # 必须是一个二维数组
                # 二维数组中必须有 product_id count 两个key 并且他们的值必须是整数
                # 二维数组中的 product_id 不能和 其他二位数组中的 product_id 重复
                'array',
                function ($order) {
                    $ids = [];
                    foreach ($order as $item) {
                        if (!is_array($item)
                            || !key_exists('product_id', $item)
                            || !key_exists('count', $item)
                            || !is_numeric($item['product_id'])
                            || !is_numeric($item['count'])
                            || in_array($item['product_id'], $ids)
                        ) {
                            return false;
                        }
                        array_push($ids, $item['product_id']);
                    }
                    return true;
                },
            ],
        ]);
        # handle
        (new Model())->handle(input('data'));
        # return
        return json(['code' => 1, 'success']);
    }
}