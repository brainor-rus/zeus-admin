<?php

namespace Zeus\Admin\Navigation;


class NavigationDefault
{
    public static function getNavigationList()
    {
        $navigation = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/Users',
                'icon' => 'fas fa-users',
                'text' => 'Пользователи',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/zeusAdmin/Users',
                        'icon' => 'fas fa-list',
                        'text' => 'Список'
                    ],
                    [
                        'url' => '/zeusAdmin/Permissions',
                        'icon' => 'fas fa-crown',
                        'text' => 'Привелегии'
                    ],
                    [
                        'url' => '/zeusAdmin/Roles',
                        'icon' => 'fas fa-user-circle',
                        'text' => 'Роли'
                    ],
                ]
            ],
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/Settings',
                'icon' => 'fas fa-cogs',
                'text' => 'Настройки',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/zeusAdmin/InterfaceLang',
                        'icon' => 'fas fa-window-maximize',
                        'text' => 'Интерфейс'
                    ],
                    [
                        'url' => '/zeusAdmin/Commissions',
                        'icon' => 'fas fa-percentage',
                        'text' => 'Коммиссии'
                    ],
                    [
                        'url' => '/zeusAdmin/Currencies',
                        'icon' => 'fas fa-dollar-sign',
                        'text' => 'Валюты'
                    ],
                    [
                        'url' => '/zeusAdmin/ContactEmails',
                        'icon' => 'fas fa-at',
                        'text' => 'Имейлы'
                    ],
                ]
            ]
        ];

        return $navigation;
    }
}