<?php


namespace app\api\controller;


use app\api\model\UserAddress;
use app\api\Success;
use app\api\validate\UserAddressValidate;

class UserAddressController extends Controller
{
    public function createOrUpdate()
    {
        $data = [
            'id'       => input('id'),
            'name'     => input('name'),
            'mobile'   => input('mobile'),
            'country'  => input('country'),
            'province' => input('province'),
            'city'     => input('city'),
            'detail'   => input('detail'),
        ];

        (new UserAddressValidate())->doCheck($data);

        UserAddress::findOrEmpty($data['id'])->save($data);

        return new Success();
    }
}