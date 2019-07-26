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
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminPosts',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Записи',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminComments',
                        'icon' => 'fas fa-users',
                        'text' => 'Комментарии',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTerms',
                        'icon' => 'fas fa-users',
                        'text' => 'Рубрики',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTags',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Метки',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminMenus',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Меню',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminFiles',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Файлы',
                        'sectionPath' => 'Zeus\Admin\Cms\Sections\\'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self())->pluginNav;
    }

}