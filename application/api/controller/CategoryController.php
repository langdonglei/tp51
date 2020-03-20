<?php


namespace app\api\controller;


use app\api\model\Category;

class CategoryController extends Controller
{
    public function all()
    {
        $return = Category::select();
        if ($return->isEmpty()) {
            throw new \Exception('not found');
        }

        return $return;
    }
}