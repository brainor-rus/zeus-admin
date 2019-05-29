<?php

//Route::post('/'.config('bradmin.admin_url').'/pay/banks', [
//    'as'   => 'bradmin.pay.banks.display',
//    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@displayBanks',
//]);

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}', [
    'as'   => 'bradmin.pay.banks.display-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@showRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/create', [
    'as'   => 'bradmin.pay.banks.create-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@createRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/{id}/edit', [
    'as'   => 'bradmin.pay.banks.edit-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@editRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/{id}/create-action', [
    'as'   => 'bradmin.pay.banks.create-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@createActionRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/{id}/edit-action', [
    'as'   => 'bradmin.pay.banks.edit-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@editActionRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/{id}/delete', [
    'as'   => 'bradmin.pay.banks.delete-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@deleteActionRouteRedirect',
]);