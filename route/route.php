<?php
Route::miss(function () {
    return json([
        'code'    => 0,
        'message' => 'url not found'
    ], 404);
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







