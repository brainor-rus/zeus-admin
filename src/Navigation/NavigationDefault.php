<?php

namespace Zeus\Admin\Navigation;


class NavigationDefault
{
    public static function getNavigationList()
    {
        $navigation = [
            [
                'url' => '/'.config('bradmin.admin_url').'/Users',
                'icon' => 'fas fa-users',
                'text' => 'Пользователи',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/bradmin/Users',
                        'icon' => 'fas fa-list',
                        'text' => 'Список'
                    ],
                    [
                        'url' => '/bradmin/Permissions',
                        'icon' => 'fas fa-crown',
                        'text' => 'Привелегии'
                    ],
                    [
                        'url' => '/bradmin/Roles',
                        'icon' => 'fas fa-user-circle',
                        'text' => 'Роли'
                    ],
                ]
            ],
            [
                'url' => '/'.config('bradmin.admin_url').'/Settings',
                'icon' => 'fas fa-cogs',
                'text' => 'Настройки',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/bradmin/InterfaceLang',
                        'icon' => 'fas fa-window-maximize',
                        'text' => 'Интерфейс'
                    ],
                    [
                        'url' => '/bradmin/Commissions',
                        'icon' => 'fas fa-percentage',
                        'text' => 'Коммиссии'
                    ],
                    [
                        'url' => '/bradmin/Currencies',
                        'icon' => 'fas fa-dollar-sign',
                        'text' => 'Валюты'
                    ],
                    [
                        'url' => '/bradmin/ContactEmails',
                        'icon' => 'fas fa-at',
                        'text' => 'Имейлы'
                    ],
                ]
            ]
        ];

        return $navigation;
    }
}