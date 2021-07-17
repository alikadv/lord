<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Machines
    Route::post('machines/media', 'MachinesApiController@storeMedia')->name('machines.storeMedia');
    Route::apiResource('machines', 'MachinesApiController');

    // Products
    Route::post('products/media', 'ProductsApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductsApiController');

    // Operator
    Route::post('operators/media', 'OperatorApiController@storeMedia')->name('operators.storeMedia');
    Route::apiResource('operators', 'OperatorApiController');

    // Order
    Route::post('orders/media', 'OrderApiController@storeMedia')->name('orders.storeMedia');
    Route::apiResource('orders', 'OrderApiController');

    // Order Details
    Route::post('order-details/media', 'OrderDetailsApiController@storeMedia')->name('order-details.storeMedia');
    Route::apiResource('order-details', 'OrderDetailsApiController');
});
