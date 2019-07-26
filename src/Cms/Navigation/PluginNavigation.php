<?php

namespace Zeus\Admin\Cms\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/cms',
                'icon' => 'fas fa-users',
                'text' => 'CMS',
                'noDirect' => true,
                'nodes' => [
                    app()->get('PluginsData')['CmsData']['Navigation'] ?? [],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminPages',
                        'icon' => 'fas fa-users',
                        'text' => 'Страницы',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_pages_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_pages_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminPages'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminPosts',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Записи',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_posts_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_posts_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminPosts'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminComments',
                        'icon' => 'fas fa-users',
                        'text' => 'Комментарии',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_comments_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_comments_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminComments'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTerms',
                        'icon' => 'fas fa-users',
                        'text' => 'Рубрики',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_terms_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_terms_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminTerms'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTags',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Метки',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_tags_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_tags_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminTags'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminMenus',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Меню',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_menus_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_menus_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminMenus'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminFiles',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Файлы',
                        'sectionPath' => !empty(config('ZeusAdmin.cms_files_section')) ?
                            config('ZeusAdmin.user_path') . config('ZeusAdmin.cms_files_section') : 'Zeus\Admin\Cms\Sections\ZeusAdminFiles'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self())->pluginNav;
    }

}