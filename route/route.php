<?php
Route::miss(function () {
    return json([
        'code'    => 0,
        'message' => 'url not found'
    ], 404);
});
Route::post('/github_webhook', function () {
    $s1 = $_SERVER['HTTP_X_HUB_SIGNATURE'];
    $s2 = 'sha1=' . hash_hmac('sha1', file_get_contents('php://input'), Env::get('GITHUB_WEBHOOK_SECRET'));
    if ($s1 == $s2) {
        $path = Env::get('root_path');
        $proc = proc_open("cd $path && git pull", [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        echo stream_get_contents($pipes[1]);
        echo stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($proc);

    }
    return json([
        'code'    => 1,
        'message' => 'ok'
    ], 200);
});
Route::get('banner/one', 'api/BannerController/one');
Route::get('category/all', 'api/CategoryController/all');
Route::get('product/one', 'api/ProductController/one');
Route::get('product/recent', 'api/ProductController/recent');
Route::get('product/some', 'api/ProductController/some');
Route::get('theme/some', 'api/ThemeController/some');

Route::post('token/get', 'api/TokenController/get');
Route::post('order/create', 'api/OrderController/create')->middleware('Auth');
Route::post('user_address/create_or_update', 'api/UserAddressController/createOrUpdate')->middleware('Auth');







