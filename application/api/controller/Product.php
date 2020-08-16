<?php


namespace app\api\controller;


use app\api\validate\CategoryIDValidate;
use app\api\validate\CountValidate;
use app\api\validate\IDValidate;

class Product extends Controller
{
    public function one()
    {
        $data = ['id' => input('id')];

        (new IDValidate())->doCheck($data);

        $result = \app\api\model\Product::with([
            'image',
            'productProperty',
            'productImage' => function ($query) {
                $query->with('image')->order('order', 'asc');
            }
        ])->findOrEmpty($data['id']);
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }

    public function recent($count = 15)
    {
        $data = ['count' => input('count')];

        (new CountValidate)->doCheck($data);

        $result = \app\api\model\Product::with('image')->order('create_time', 'desc')->limit($count)->select();
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }

    public function some($category_id)
    {
        $data = ['category_id' => input('category_id')];

        (new CategoryIDValidate())->doCheck($data);

        $result = \app\api\model\Product::where('category_id', $category_id)->select();
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }
}