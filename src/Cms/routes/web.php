<?php

Route::group(['middleware' => config('zeusAdmin.middleware')], function () {
    // Редиректы /////////////////////////////////////////////////////////////////////////////

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{section}', [
        'as'   => 'zeusAdmin.cms.pages.display',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@showRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}', [
        'as'   => 'zeusAdmin.cms.banks.display-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@showRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}/create', [
        'as'   => 'zeusAdmin.cms.banks.create-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@createRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}/{id}/edit', [
        'as'   => 'zeusAdmin.cms.banks.edit-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@editRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}/{id}/create-action', [
        'as'   => 'zeusAdmin.cms.banks.create-action-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@createActionRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}/{id}/edit-action', [
        'as'   => 'zeusAdmin.cms.banks.edit-action-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@editActionRouteRedirect',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/{sectionName}/{id}/delete', [
        'as'   => 'zeusAdmin.cms.banks.delete-action-plugin',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@deleteActionRouteRedirect',
    ]);

//Route::get('/' .config('zeusAdmin.cms_url_prefix') . '/{path}' , [
//    'as'   => 'zeusAdmin.cms.page.parseUrl',
//    'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@parseUrl',
//])->where('path', '[a-zA-Z0-9/_-]+');
    Route::get(config('zeusAdmin.cms_url_prefix') . '/' .config('zeusAdmin.cms_page_prefix') . '/{slug}' , [
        'as'   => 'zeusAdmin.cms.post.show',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@showPost',
    ]);
    Route::get(config('zeusAdmin.cms_url_prefix') . '/' .config('zeusAdmin.cms_post_prefix') . '/{slug}' , [
        'as'   => 'zeusAdmin.cms.post.show',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@showPost',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/cms/files/upload', [
        'as'   => 'zeusAdmin.cms.file-upload',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@fileUpload',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/api/tree-elements/menu/create', [
        'as'   => 'zeusAdmin.tree.menu.create',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@menuElementCreate',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/api/tree-elements/menu/edit', [
        'as'   => 'zeusAdmin.tree.menu.edit',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@menuElementEdit',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/api/tree-elements/menu/delete', [
        'as'   => 'zeusAdmin.tree.menu.delete',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@menuElementDelete',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/api/tree-elements/menu/reorder', [
        'as'   => 'zeusAdmin.tree.menu.reorder',
        'uses' => 'Zeus\Admin\Cms\Controllers\CmsController@menuElementsReorder',
    ]);
});