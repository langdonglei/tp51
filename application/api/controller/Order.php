<?php


namespace app\api\controller;


use app\api\service\OrderService;
use app\api\validate\OrderValidate;
use think\facade\Request;

class OrderController extends Controller
{
    public function create()
    {
        $data = ['order' => input('order')];

        (new OrderValidate())->doCheck($data);

        $result = OrderService::handle($data['order']);

        return $result;
    }
}