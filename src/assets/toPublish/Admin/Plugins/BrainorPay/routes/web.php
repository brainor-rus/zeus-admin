<?php

//Route::post('/'.config('zeusAdmin.admin_url').'/pay/banks', [
//    'as'   => 'zeusAdmin.pay.banks.display',
//    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@displayBanks',
//]);

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}', [
    'as'   => 'zeusAdmin.pay.banks.display-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@showRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}/create', [
    'as'   => 'zeusAdmin.pay.banks.create-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@createRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}/{id}/edit', [
    'as'   => 'zeusAdmin.pay.banks.edit-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@editRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}/{id}/create-action', [
    'as'   => 'zeusAdmin.pay.banks.create-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@createActionRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}/{id}/edit-action', [
    'as'   => 'zeusAdmin.pay.banks.edit-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@editActionRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/pay/{sectionName}/{id}/delete', [
    'as'   => 'zeusAdmin.pay.banks.delete-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorPay\Controllers\BrainorPayController@deleteActionRouteRedirect',
]);