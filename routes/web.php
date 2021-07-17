<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Machines
    Route::delete('machines/destroy', 'MachinesController@massDestroy')->name('machines.massDestroy');
    Route::post('machines/media', 'MachinesController@storeMedia')->name('machines.storeMedia');
    Route::post('machines/ckmedia', 'MachinesController@storeCKEditorImages')->name('machines.storeCKEditorImages');
    Route::resource('machines', 'MachinesController');

    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductsController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductsController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductsController');

    // Operator
    Route::delete('operators/destroy', 'OperatorController@massDestroy')->name('operators.massDestroy');
    Route::post('operators/media', 'OperatorController@storeMedia')->name('operators.storeMedia');
    Route::post('operators/ckmedia', 'OperatorController@storeCKEditorImages')->name('operators.storeCKEditorImages');
    Route::resource('operators', 'OperatorController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/media', 'OrderController@storeMedia')->name('orders.storeMedia');
    Route::post('orders/ckmedia', 'OrderController@storeCKEditorImages')->name('orders.storeCKEditorImages');
    Route::resource('orders', 'OrderController');

    // Order Details
    Route::delete('order-details/destroy', 'OrderDetailsController@massDestroy')->name('order-details.massDestroy');
    Route::post('order-details/media', 'OrderDetailsController@storeMedia')->name('order-details.storeMedia');
    Route::post('order-details/ckmedia', 'OrderDetailsController@storeCKEditorImages')->name('order-details.storeCKEditorImages');
    Route::resource('order-details', 'OrderDetailsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
