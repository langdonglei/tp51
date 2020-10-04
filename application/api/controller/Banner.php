<?php


namespace app\api\controller\v1;

use app\api\controller\Controller;

class Banner extends Controller
{
    protected $failException = true;

    public function get()
    {
        $this->validate($this->request->get(), [
            'id' => 'require',
        ]);

        $r = \app\api\model\Banner::getOrFail(input('id'));
        var_dump($r);
        echo 333;
    }




//        (new IDValidate())->doCheck($data);

//        $result = Banner::with('bannerItem,bannerItem.image')->findOrEmpty($data['id']);
//        if ($result->isEmpty()) {
//            throw new \Exception('not found');
//        }

//        return $result;
//}
}