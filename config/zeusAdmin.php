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
    'cms_terms_templates_path' => 'zeusAdmin.cms.templates.terms',
    'cms_url_prefix' => 'cms',
    'cms_page_prefix' => 'page',
    'cms_post_prefix' => 'post',
    'cms_term_prefix' => 'term',

//    'locale_field' => '',

//    'page_model' => 'App\\CustomPageModel',
//    'post_model' => 'App\\CustomPostModel',

//    'cms_comments_section' => '',
//    'cms_files_section' => '',
//    'cms_menus_section' => '',
//    'cms_pages_section' => '',
//    'cms_posts_section' => '',
//    'cms_tags_section' => '',
//    'cms_terms_section' => '',

    'cms_comments_check_access' => false,
    'cms_files_check_access' => false,
    'cms_menus_check_access' => false,
    'cms_pages_check_access' => false,
    'cms_posts_check_access' => false,
    'cms_tags_check_access' => false,
    'cms_terms_check_access' => false,

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
