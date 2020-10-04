<?php


namespace app\api\controller;

use app\api\model\Banner as Model;
use think\Controller;

class Banner extends Controller
{
    protected $failException = true;

    public function getAllByGid()
    {
        $this->validate($this->request->get(), [
            'gid' => 'require',
        ]);
        return json(
            Model
                ::with('image')
                ->where('group_id', input('gid'))
                ->all()
        );
    }
}