<?php


namespace app\api\model;


class UserAddress extends Model
{
    public function user()
    {
        return parent::belongsTo(User::class);
    }
}