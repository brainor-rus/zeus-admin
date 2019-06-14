<?php
Route::group(['middleware' => config('zeusAdmin.middleware')], function () {

    Route::any('/'.config('zeusAdmin.admin_url'), [
        'as'   => 'zeusAdmin.index',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getIndex',
    ]);

    Route::any('/'.config('zeusAdmin.admin_url').'/images/{path}', [
        'as'   => 'zeusAdmin.getImage',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getImage',
    ]);

    Route::get('/'.config('zeusAdmin.admin_url').'/{any}', 'Zeus\Admin\Controllers\ZeusAdminController@getIndex')->where('any', '.*');

    Route::post('/'.config('zeusAdmin.admin_url').'/dashboard', [
        'as'   => 'zeusAdmin.dashboard',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getDashboard',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/sidebar-menu', [
        'as'   => 'zeusAdmin.sidebarMenu',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getSidebarMenu',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}', [
        'as'   => 'zeusAdmin.section.display',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getDisplay',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/create', [
        'as'   => 'zeusAdmin.section.create.form',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getCreate',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/create-action', [
        'as'   => 'zeusAdmin.section.create.form',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@createAction',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/{id}/edit/', [
        'as'   => 'zeusAdmin.section.edit.form',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@getEdit',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/{id}/edit-action/', [
        'as'   => 'zeusAdmin.section.edit.form.action',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@editAction',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/update', [
        'as'   => 'zeusAdmin.section.update.action',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@postEdit',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/{section}/{id}/delete', [
        'as'   => 'zeusAdmin.section.delete.action',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@deleteAction',
    ]);

    Route::post('/'.config('zeusAdmin.admin_url').'/api/media_library/insert_media/image_list', [
        'as'   => 'zeusAdmin.media_library.insert_media.image_list',
        'uses' => 'Zeus\Admin\Controllers\ZeusAdminController@imageList',
    ]);

});