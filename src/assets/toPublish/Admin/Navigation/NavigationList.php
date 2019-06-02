<?php

namespace App\Admin\Navigation;


class NavigationList
{
    public static function getNavigationList()
    {
        $navigation = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/Users',
                'icon' => 'fas fa-users',
                'text' => 'Пользователи2',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/Users',
                        'icon' => 'fas fa-list',
                        'text' => 'Список'
                    ],
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/Permissions',
                        'icon' => 'fas fa-crown',
                        'text' => 'Привелегии'
                    ],
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/Roles',
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
                        'url' => '/' . config('zeusAdmin.admin_url') . '/InterfaceLang',
                        'icon' => 'fas fa-window-maximize',
                        'text' => 'Интерфейс'
                    ],
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/Commissions',
                        'icon' => 'fas fa-percentage',
                        'text' => 'Коммиссии'
                    ],
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/Currencies',
                        'icon' => 'fas fa-dollar-sign',
                        'text' => 'Валюты'
                    ],
                    [
                        'url' => '/' . config('zeusAdmin.admin_url') . '/ContactEmails',
                        'icon' => 'fas fa-at',
                        'text' => 'Имейлы'
                    ],
                ]
            ]
        ];

        return $navigation;
    }
}