<?php
return [
    'default_return_type'  => 'json',
    'exception_handle'     => function ($e) {
//        if ($e instanceof \think\Exception) {
//            return (new \think\exception\Handle())->render($e);
//        }
        return json([
            'code'    => $e->getCode(),
            'message' => $e->getMessage()
        ], 400);
    }
];