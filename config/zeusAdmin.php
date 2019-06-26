<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin url
    |--------------------------------------------------------------------------
    |
    | Root part of admin url.
    |
    */

    'admin_url' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Admin user path
    |--------------------------------------------------------------------------
    |
    | Path to user-side directory of admin published files.
    |
    */

    'user_path' => 'App\Admin',

    'base_models_path' => 'App\\',

    /*
    |--------------------------------------------------------------------------
    | CMS
    |--------------------------------------------------------------------------
    |
    */

    'cms_pages_templates_path' => 'zeusAdmin.cms.templates.pages',
    'cms_posts_templates_path' => 'zeusAdmin.cms.templates.posts',
    'cms_url_prefix' => 'cms',
    'cms_page_prefix' => 'page',
    'cms_post_prefix' => 'post',

//    'page_model' => 'App\\CustomPageModel',
//    'post_model' => 'App\\CustomPostModel',

//    'cms_comments_section' => '',
//    'cms_files_section' => '',
//    'cms_menus_section' => '',
//    'cms_pages_section' => '',
//    'cms_posts_section' => '',
//    'cms_tags_section' => '',
//    'cms_terms_section' => '',

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Displayed in title and header.
    |
    */

    'title' => 'Zeus Admin',

    /*
    |--------------------------------------------------------------------------
    | Admin Logo
    |--------------------------------------------------------------------------
    |
    | Displayed in navigation panel.
    |
    */


//    'logo'      => '/images/user-logo.jpg',
    'logo'      => '/packages/zeusAdmin/images/brainor-logo.svg',

//    'logo_mini' => '',


    /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    |
    */

    'display_table_filter_default_position' => 'top', // top|bottom

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    */

    'middleware' => ['web'],

];
