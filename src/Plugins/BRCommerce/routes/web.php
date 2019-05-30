<?php

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('zeusAdmin.admin_url').'/BRCommerce/{sectionName}', [
    'as'   => 'zeusAdmin.BRCommerce.display-plugin',
    'uses' => 'Zeus\Admin\Plugins\BRCommerce\Controllers\BRCommerceController@showRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BRCommerce/{sectionName}/create', [
    'as'   => 'zeusAdmin.BRCommerce.create-plugin',
    'uses' => 'Zeus\Admin\Plugins\BRCommerce\Controllers\BRCommerceController@createRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BRCommerce/{sectionName}/{id}/edit', [
    'as'   => 'zeusAdmin.BRCommerce.edit-plugin',
    'uses' => 'Zeus\Admin\Plugins\BRCommerce\Controllers\BRCommerceController@editRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BRCommerce/{sectionName}/{id}/delete', [
    'as'   => 'zeusAdmin.BRCommerce.delete-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BRCommerce\Controllers\BRCommerceController@deleteActionRouteRedirect',
]);