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
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminPages',
                        'icon' => 'fas fa-users',
                        'text' => 'Страницы'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminPosts',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Записи'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminComments',
                        'icon' => 'fas fa-users',
                        'text' => 'Комментарии'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTerms',
                        'icon' => 'fas fa-users',
                        'text' => 'Рубрики'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminTags',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Метки'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/ZeusAdminFiles',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Файлы'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self())->pluginNav;
    }

}