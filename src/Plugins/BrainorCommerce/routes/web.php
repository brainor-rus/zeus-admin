<?php

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('zeusAdmin.admin_url').'/BrainorCommerce/{sectionName}', [
    'as'   => 'zeusAdmin.BrainorCommerce.display-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorCommerce\Controllers\BrainorCommerceController@showRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BrainorCommerce/{sectionName}/create', [
    'as'   => 'zeusAdmin.BrainorCommerce.create-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorCommerce\Controllers\BrainorCommerceController@createRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BrainorCommerce/{sectionName}/{id}/edit', [
    'as'   => 'zeusAdmin.BrainorCommerce.edit-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorCommerce\Controllers\BrainorCommerceController@editRouteRedirect',
]);

Route::post('/'.config('zeusAdmin.admin_url').'/BrainorCommerce/{sectionName}/{id}/delete', [
    'as'   => 'zeusAdmin.BrainorCommerce.delete-action-plugin',
    'uses' => 'Zeus\Admin\Plugins\BrainorCommerce\Controllers\BrainorCommerceController@deleteActionRouteRedirect',
]);