<?php


namespace app\api\model;


class User extends Model
{
    public function userAddress()
    {
        return parent::hasMany(UserAddress::class);
    }
}