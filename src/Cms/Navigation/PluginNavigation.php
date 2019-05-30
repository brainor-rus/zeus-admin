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
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRPages',
                        'icon' => 'fas fa-users',
                        'text' => 'Страницы'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRPosts',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Записи'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRComments',
                        'icon' => 'fas fa-users',
                        'text' => 'Комментарии'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRTerms',
                        'icon' => 'fas fa-users',
                        'text' => 'Рубрики'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRTags',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Метки'
                    ],
                    [
                        'url' => '/'.config('zeusAdmin.admin_url').'/cms/BRFiles',
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