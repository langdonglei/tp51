<?php


namespace app\api\controller;


use app\api\model\Product as Model;
use think\Controller;

class Product extends Controller
{
    protected $failException = true;

    public function getOneById()
    {
        $this->validate($this->request->get(), [
            'id' => 'require|integer',
        ]);
        return json(
            Model
                ::getOrFail(input('id', 1))
        );
    }

    public function getAllByCount()
    {
        $this->validate($this->request->get(), [
            'count' => 'require|integer|max,15'
        ]);
        return json(
            Model
                ::limit(input('count'))
                ->all()
        );
    }

    public function getAllByGid()
    {
        $this->validate($this->request->get(), [
            'gid' => 'require|integer'
        ]);
        return json(
            Model
                ::with('coverImage,detailImages')
                ->where('group_id', input('gid'))
                ->all()
        );
    }
}