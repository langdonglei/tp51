<?php


namespace app\api\controller;


use app\api\model\Product;
use app\api\model\ProductProperty;
use app\api\validate\CategoryIDValidate;
use app\api\validate\CountValidate;
use app\api\validate\IDValidate;

class ProductController extends Controller
{
    public function one()
    {
        $data = ['id' => input('id')];

        (new IDValidate())->doCheck($data);

        $result = Product::with([
            'productProperty', 'productImage' => function ($query) {
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

        $result = Product::limit($count)->order('create_at', 'desc')->select();
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }

    public function some($category_id)
    {
        $data = ['category_id' => input('category_id')];

        (new CategoryIDValidate())->doCheck($data);

        $result = Product::where('category_id', $category_id)->select();
        if ($result->isEmpty()) {
            throw new \Exception('not found');
        }

        return $result;
    }
}